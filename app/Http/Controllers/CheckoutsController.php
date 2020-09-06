<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use Ixudra\Curl\Facades\Curl;

class CheckoutsController extends Controller
{
    protected $cart;
    protected $order;
    protected $orderdetail;
    protected $book;
    protected $discount;

    public function __construct(Cart $cart, Order $order, Orderdetail $orderdetail, Book $book, Discount $discount)
    {
        $this->cart = $cart;
        $this->order = $order;
        $this->orderdetail = $orderdetail;
        $this->book = $book;
        $this->discount = $discount;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = $request->books;

        if ($data == null) {
            return redirect()->route('carts.index');
        }

        $i = 0;
        foreach ($data as $value) {
            $books[$i] = $this->book->find($value['id']);
            if ($books[$i] == null) {
                flash('Book #' . $value['id'] . 'is not existed');
                return back();
            }
            $books[$i]['quantity'] = $value['quantity'];
            $i++;
        }
        return view('checkout.index')->with('books', $books);

    }


    public function quickCheckout(Request $request)
    {
        if (!isset($request->books[0]['id']) || !isset($request->books[0]['quantity'])) {
            flash('Error. Please try again!')->error();
            return redirect()->back();
        }
        $data = $request->duplicate();
        $data->merge(['book_id' => $data->books[0]['id'], 'quantity' => $data->books[0]['quantity']]);
        $data->offsetUnset('books');

        $this->cart->saveCart($data);

        return $this->index($request);
    }


    public function checkCouponCode($request, $total)
    {
        if (isset($request->discount) && $request->discount != null) {
            $discount = $this->discount->where('code', $request->discount)->first();

            if ($discount != null && date($discount->start_time) <= now() && (is_null($discount->end_time) || (!is_null($discount->end_time) && date($discount->end_time) >= now())) && (is_null($discount->price_condition) || (!is_null($discount->price_condition) && $discount->price_condition < $total)) && (is_null($discount->num_condition) || (!is_null($discount->num_condition) && $discount->num_condition > 0))) {
                return true;
            }
            return false;
        }
    }

    /**
     * Checkout offline
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //check is cart empty?
        $cart = $this->cart->where('user_id', '=', Auth::id())->first();
        if ($cart == null) {
            flash('Order failed');
            return redirect()->route('carts.index');
        }

        $books = $request->books;

        $total = 0;

        // create order
        foreach ($books as $value) {
            $book = $this->book->find($value['id']);
            if ($book == null) {
                $book = $this->book->withTrashed()->where('id', $value['id'])->get();
                if ($book == null) {
                    flash('Book #' . $value['id'] . 'is not exist');
                    return back();
                }
                flash('Book ' . $book->name . 'was deleted');
                return back();
            }
            $total += $book->price * $value['quantity'];
        }

        $total += $request->shipFee;

        //check coupon code
        $checkCoupon = $this->checkCouponCode($request, $total);
        $discount = null;
        if ($checkCoupon) {
            $discount = $this->discount->where('code', $request->discount)->first();
            $discount->num_condition--;
            $discount->save();
            if ($total - $discount->discount > 0) {
                $total -= $discount->discount;
            } else {
                $total = 0;
            }
        }

        if (!isset($request->shipFee) || $request->shipFee < 0) {
            $ship_fee = 0;
        } else {
            $ship_fee = $request->shipFee;
        }

        // create order
        if ($discount == null) {
            $order = $this->order->create(['user_id' => Auth::id(), 'total_price' => $total, 'ship_fee' => $ship_fee, 'name' => $request->name, 'phone' => $request->phone, 'email' => $request->email, 'address' => $request->address, 'company' => $request->company]);
        } else {
            $order = $this->order->create(['user_id' => Auth::id(), 'total_price' => $total, 'ship_fee' => $ship_fee, 'name' => $request->name, 'phone' => $request->phone, 'email' => $request->email, 'address' => $request->address, 'company' => $request->company, 'discount_id' => $discount->id, 'discount' => $discount->discount]);
        }

        // create order detail
        foreach ($books as $value) {
            $book = $this->book->find($value['id']);
            $data['order_id'] = $order->id;
            $data['book_id'] = $book->id;
            $data['sell_price'] = $book->price;
            $data['quantity'] = $value['quantity'];
            $this->orderdetail->create($data);
        }

        $this->cart->removeCartOfUser();

        flash('Order Succeed')->success();
        return redirect()->route('carts.index');
    }

    //----------------------------- Checkout by point  ----------------------------------------------
    public function checkoutByPoint(Request $request)
    {
        //check is cart empty?
        $cart = $this->cart->where('user_id', '=', Auth::id())->first();
        if ($cart == null) {
            flash('Order failed');
            return redirect()->route('carts.index');
        }

        $books = $request->books;

        $total = 0;
        // create order
        foreach ($books as $value) {
            $book = $this->book->find($value['id']);
            if ($book == null) {
                $book = $this->book->withTrashed()->where('id', $value['id'])->get();
                if ($book == null) {
                    flash('Book #' . $value['id'] . 'is not exist');
                    return back();
                }
                flash('Book ' . $book->name . 'was deleted');
                return back();
            }
            $total += $book->price * $value['quantity'];
        }

        $total += $request->shipFee;

        //check coupon code
        $checkCoupon = $this->checkCouponCode($request, $total);
        $discount = null;
        if ($checkCoupon) {
            $discount = $this->discount->where('code', $request->discount)->first();
            $discount->num_condition--;
            $discount->save();

            if ($total - $discount->discount > 0) {
                $total -= $discount->discount;
            } else {
                $total = 0;
            }
        }

        if ($total > Auth::user()->point) {
            flash('Not enough point to buy')->warning();
            return redirect()->route('carts.index');
        }

        $user = Auth::user();
        $user->point -= $total;
        $user->save();

        if (!isset($request->shipFee) || $request->shipFee < 0) {
            $ship_fee = 0;
        } else {
            $ship_fee = $request->shipFee;
        }

        if ($discount == null) {
            $order = $this->order->create(['user_id' => Auth::id(), 'total_price' => $total, 'ship_fee' => $ship_fee, 'name' => $request->name, 'phone' => $request->phone, 'email' => $request->email, 'address' => $request->address, 'company' => $request->company, 'payment' => 'point', 'pay_status' => true]);
        } else {
            $order = $this->order->create(['user_id' => Auth::id(), 'total_price' => $total, 'ship_fee' => $ship_fee, 'name' => $request->name, 'phone' => $request->phone, 'email' => $request->email, 'address' => $request->address, 'company' => $request->company, 'discount_id' => $discount->id, 'discount' => $discount->discount, 'payment' => 'point', 'pay_status' => true]);
        }

        // create order detail
        foreach ($books as $value) {
            $book = $this->book->find($value['id']);
            $data['order_id'] = $order->id;
            $data['book_id'] = $book->id;
            $data['sell_price'] = $book->price;
            $data['quantity'] = $value['quantity'];
            $this->orderdetail->create($data);
        }

        $this->cart->removeCartOfUser();

        flash('Order Succeed')->success();
        return redirect()->route('carts.index');
    }

    //----------------------------- Checkout online common  -------------------------------------------
    public function savePoint($user_id, $total_price)
    {
        $save = 3 / 100;

        $user = User::find($user_id);
        $user->point += floor($total_price * $save * 10) / 10;
        $user->save();
    }

    //----------------------------- Checkout by MoMo ------------------------------------------------

    /**
     * Checkout by MoMo (send request to MoMo)
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function momoRequest(Request $request)
    {
        //check is cart empty?
        $cart = $this->cart->where('user_id', '=', Auth::id())->first();
        if ($cart == null) {
            flash('Order failed');
            return redirect()->route('carts.index');
        }

        $books = $request->books;
        $orderInfo = '';

        $total = 0;
        // create order
        foreach ($books as $value) {
            $book = $this->book->find($value['id']);
            if ($book == null) {
                $book = $this->book->withTrashed()->where('id', $value['id'])->get();
                if ($book == null) {
                    flash('Book #' . $value['id'] . 'is not exist');
                    return back();
                }
                flash('Book ' . $book->name . 'was deleted');
                return back();
            }
            $total += $book->price * $value['quantity'];
        }

        $total += $request->shipFee;

        //check coupon code
        $checkCoupon = $this->checkCouponCode($request, $total);
        $discount = null;
        if ($checkCoupon) {
            $discount = $this->discount->where('code', $request->discount)->first();
            $discount->num_condition--;
            $discount->save();

            if ($total - $discount->discount > 0) {
                $total -= $discount->discount;
            } else {
                $total = 0;
            }
        }

        if (!isset($request->shipFee) || $request->shipFee < 0) {
            $ship_fee = 0;
        } else {
            $ship_fee = $request->shipFee;
        }

        // create order
        if ($discount == null) {
            $order = $this->order->create(['user_id' => Auth::id(), 'total_price' => $total, 'ship_fee' => $ship_fee, 'name' => $request->name, 'phone' => $request->phone, 'email' => $request->email, 'address' => $request->address, 'company' => $request->company]);
        } else {
            $order = $this->order->create(['user_id' => Auth::id(), 'total_price' => $total, 'ship_fee' => $ship_fee, 'name' => $request->name, 'phone' => $request->phone, 'email' => $request->email, 'address' => $request->address, 'company' => $request->company, 'discount_id' => $discount->id, 'discount' => $discount->discount]);
        }

        // create order detail
        foreach ($books as $value) {
            $book = $this->book->find($value['id']);
            $data['order_id'] = $order->id;
            $data['book_id'] = $book->id;
            $data['sell_price'] = $book->price;
            $data['quantity'] = $value['quantity'];
            $this->orderdetail->create($data);

            $orderInfo .= $book->name . '  ' . $book->price . '$  x' . $value['quantity'] . '\n';
        }


        $this->cart->removeCartOfUser();

        $orderInfo .= 'Total: ' . $order->total_price . '$';
        $response = \MoMoAIO::purchase([
            'amount' => $order->total_price * 20000,
            'orderId' => $order->id,
            'requestId' => $order->id,
            'returnUrl' => route('momo.getSuccess'),
            'notifyUrl' => route('momo.notify'),
            'orderInfo' => $orderInfo,
        ])->send();

        if ($response->errorCode == 0) {
            $redirectUrl = $response->getRedirectUrl();
            $order->payment = 'MoMo';
            $order->payUrl = $redirectUrl;
            $order->save();
            return redirect()->to($redirectUrl);
        }

        flash($response->getMessage());
        return redirect()->back();
    }

    public function getSuccessMomo(Request $request)
    {
        if ($request->errorCode == 0) {
            flash('Order and Checkout successful');
        } else
            flash('Order and checkout fail');
        return redirect()->route('carts.index');
    }

    public function momoNotify(Request $request)
    {
        if (!isset($request->orderId) || !isset($request->errorCode)) {
            return false;
        }

        $order = $this->order->find($request->orderId);
        if ($order == null) {
            return false;
        }

        if ($request->errorCode == 0) {
            $order->pay_status = true;
            $order->transId = $request->transId;
            $order->save();

            $this->savePoint($order->user_id, $order->total_price);
            return true;
        } else {
            $order->forceDelete();
            return false;
        }
    }

    /**
     * Check Order 's Payment in MoMo
     * @param Request $request
     * @param $id
     */
    public function momoCheckOrder(Request $request, $id)
    {
        $response = \MoMoAIO::queryTransaction([
            'orderId' => $id,
            'requestId' => $id,
        ])->send();
        if ($response->isSuccessful()) {
            dd($response);
//            var_dump($response->getData()); // toàn bộ data do MoMo gửi về.

        } else {
            dd($response);
            print $response->getMessage();
        }
    }

//    ----------------------------------  Checkout by VNPay  ---------------------------------

    /**
     * Checkout by VNPay
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function vnpayRequest(Request $request)
    {
        //check is cart empty?
        $cart = $this->cart->where('user_id', '=', Auth::id())->first();
        if ($cart == null) {
            flash('Order failed');
            return redirect()->route('carts.index');
        }

        $books = $request->books;
        $orderInfo = '';

        $total = 0;
        // create order
        foreach ($books as $value) {
            $book = $this->book->find($value['id']);
            if ($book == null) {
                $book = $this->book->withTrashed()->where('id', $value['id'])->get();
                if ($book == null) {
                    flash('Book #' . $value['id'] . 'is not exist');
                    return back();
                }
                flash('Book ' . $book->name . 'was deleted');
                return back();
            }
            $total += $book->price * $value['quantity'];
        }

        $total += $request->shipFee;

        //check coupon code
        $checkCoupon = $this->checkCouponCode($request, $total);
        $discount = null;
        if ($checkCoupon) {
            $discount = $this->discount->where('code', $request->discount)->first();
            $discount->num_condition--;
            $discount->save();
            if ($total - $discount->discount > 0) {
                $total -= $discount->discount;
            } else {
                $total = 0;
            }
        }

        if (!isset($request->shipFee) || $request->shipFee < 0) {
            $ship_fee = 0;
        } else {
            $ship_fee = $request->shipFee;
        }

        if ($discount == null) {
            $order = $this->order->create(['user_id' => Auth::id(), 'total_price' => $total, 'ship_fee' => $ship_fee, 'name' => $request->name, 'phone' => $request->phone, 'email' => $request->email, 'address' => $request->address, 'company' => $request->company]);
        } else {
            $order = $this->order->create(['user_id' => Auth::id(), 'total_price' => $total, 'ship_fee' => $ship_fee, 'name' => $request->name, 'phone' => $request->phone, 'email' => $request->email, 'address' => $request->address, 'company' => $request->company, 'discount_id' => $discount->id, 'discount' => $discount->discount]);
        }

        // create order detail
        foreach ($books as $value) {
            $book = $this->book->find($value['id']);
            $data['order_id'] = $order->id;
            $data['book_id'] = $book->id;
            $data['sell_price'] = $book->price;
            $data['quantity'] = $value['quantity'];
            $this->orderdetail->create($data);

            $orderInfo .= $book->name . '  ' . $book->price . '$  x' . $value['quantity'] . '\n';
        }


        $this->cart->removeCartOfUser();

        $orderInfo .= 'Total: ' . $order->total_price . '$';
        $response = \VNPay::purchase([
            'vnp_OrderType' => 150000,
            'vnp_IpAddr' => $request->ip(),
            'vnp_Amount' => $order->total_price * 20000 * 100,
            'vnp_TxnRef' => $order->id,
            'vnp_ReturnUrl' => route('vnpay.getSuccess'),
            'vnp_OrderInfo' => $orderInfo,
        ])->send();

        if (!is_null($response->getRedirectUrl())) {
            $redirectUrl = $response->getRedirectUrl();
            $order->payment = 'VNPay';
            $order->payUrl = $redirectUrl;
            $order->save();
            return redirect()->to($redirectUrl);
        }

        flash($response->getMessage())->error();
        return redirect()->route('carts.index');
    }

    public function getSuccessVnpay(Request $request)
    {
        if (!isset($request->vnp_TxnRef) || !isset($request->vnp_ResponseCode)) {
            return false;
        }

        $order = $this->order->find($request->vnp_TxnRef);
        if ($order == null) {
            return false;
        }

        if ($request->vnp_ResponseCode == 00) {
            $order->pay_status = true;
            $order->transId = $request->transId;
            $order->save();
            $this->savePoint($order->user_id, $order->total_price);

            flash('Order and Checkout successful');
        } else {
            $order->forceDelete();
            flash('Order and checkout fail');
        }

        return redirect()->route('carts.index');
    }

    public function vnpayNotify(Request $request)
    {

    }

    //    ----------------------------------  Checkout by ONEPay  ---------------------------------

    /**
     * Checkout by ONEPay
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function onepayRequest(Request $request)
    {

    }

    public function getSuccessOnepay(Request $request)
    {

    }

    public function onepayNotify(Request $request)
    {

    }


    //    ----------------------------------  Checkout by VTCPay  ---------------------------------

    /**
     * Checkout by MoMo (send request to MoMo)
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function vtcpayRequest(Request $request)
    {

    }

    public function getSuccessVtcpay(Request $request)
    {

    }

    public function vtcpayNotify(Request $request)
    {

    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
