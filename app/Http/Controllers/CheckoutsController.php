<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutsController extends Controller
{
    protected $cart;
    protected $order;
    protected $orderdetail;
    protected $book;

    public function __construct(Cart $cart, Order $order, Orderdetail $orderdetail, Book $book)
    {
        $this->cart = $cart;
        $this->order = $order;
        $this->orderdetail = $orderdetail;
        $this->book = $book;
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


    /**
     * Store a newly created resource in storage.
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
        $order = $this->order->create(['user_id' => Auth::id(), 'total_price' => $total, 'name' => $request->name, 'phone' => $request->phone, 'email' => $request->email, 'address' => $request->address, 'company' => $request->company]);

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
        $order = $this->order->create(['user_id' => Auth::id(), 'total_price' => $total, 'name' => $request->name, 'phone' => $request->phone, 'email' => $request->email, 'address' => $request->address, 'company' => $request->company]);

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

        $orderInfo .= 'Total: ' . $order->total . '$';
        $response = \MoMoAIO::purchase([
            'amount' => $order->total_price * 20000,
            'orderId' => $order->id,
            'requestId' => $order->id,
            'returnUrl' => 'https://bookstore-00.online/carts',
            'notifyUrl' => 'https://bookstore-00.online/momo/notify',
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

    public function momoNotify(Request $request,$id){
        $response = \MoMoAIO::notification()->send();

        if ($response->isSuccessful()) {
            print $response->amount;
            print $response->orderId;

            var_dump($response->getData()); // toàn bộ data do MoMo gửi sang.

        } else {

            print $response->getMessage();
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
