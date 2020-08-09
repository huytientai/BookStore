<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Book;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class OrdersController extends Controller
{
    protected $order;
    protected $orderDetail;

    public function __construct(Order $order, Orderdetail $orderDetail)
    {
        $this->order = $order;
        $this->orderDetail = $orderDetail;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::any(['admin', 'staff', 'seller', 'warehouseman', 'shipper'], Auth::user())) {
            $orders = $this->searchOrders($request->all(), Auth::user()->role);

            return view('orders.index')->with('orders', $orders);
        }

        flash('you are not authorized');
        return redirect()->back();
    }

    public function searchOrders($data, $role)
    {
        if ($role == User::WAREHOUSEMAN || $role == User::SHIPPER) {
            return $this->order->where('status', '>=', Order::REQUEST)->where('status', '!=', Order::DONE)->orderBy('status')->orderBy('id')->paginate();
        }

        $builder = $this->order->with(['orderdetails' => function ($query) {
            $query->with(['book' => function ($query) {
                $query->withTrashed();
            }]);
        }])->orderBy('deleted_at')->orderBy('status')->orderBy('id');

        if (isset($data['order_id'])) {
            $builder->findOrderId($data['order_id']);
        }
        if (isset($data['name'])) {
            $builder->findName($data['name']);
        }
        if (isset($data['user_id'])) {
            $builder->findUserId($data['user_id']);
        }
        if (isset($data['phone'])) {
            $builder->findPhone($data['phone']);
        }
        if (isset($data['email'])) {
            $builder->findEmail($data['email']);
        }
        if (isset($data['address'])) {
            $builder->findAddress($data['address']);
        }
        if (isset($data['company'])) {
            $builder->findCompany($data['company']);
        }
        if (isset($data['date'])) {
            $builder->findDate($data['date']);
        }
        if (isset($data['status'])) {
            $builder->findStatus($data['status']);
        }

        if (isset($data['deleted'])) {
            if ($data['deleted'] == "true") {
                $builder->onlyTrashed();
            }
        } else $builder->withTrashed();

        return $builder->paginate();
    }

    /**
     * Show the form for editing the order after checked.(for manager)
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::any(['admin', 'staff', 'seller'], Auth::user())) {
            $order = $this->order->with(['orderdetails' => function ($query) {
                $query->with(['book' => function ($query) {
                    $query->withTrashed();
                }]);
            }])->find($id);

            if ($order == null) {
                flash('This order is not exist');
                return back();
            }

            if ($order->status < Order::CONFIRM) {
                return view('orders.edit')->with('order', $order);
            }
            flash('Cant edit this order');
            return back();
        }

        flash('You are not authorized');
        return redirect()->back();
    }

    /**
     * User edit order
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function userEdit($id)
    {
        $order = $this->order->with(['orderdetails' => function ($query) {
            $query->with(['book' => function ($query) {
                $query->withTrashed();
            }]);
        }])->find($id);

        if ($order == null) {
            flash('Order is not exist')->warning();
            return back();
        }
        if ($order->user_id != Auth::id()) {
            flash('This is not your order')->error();
            return back();
        }
        if ($order->status >= Order::CONFIRM) {
            flash('Cant update this order')->warning();
            return back();
        }

        return view('orders.user_edit')->with('order', $order);
    }

    /**
     * Update orders when in checked status.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::any(['admin', 'staff', 'seller'], Auth::user())) {
            $order = $this->order->find($id);

            if ($order == null) {
                flash('This order is not exist');
                return redirect()->back();
            }

            if ($order->status != Order::CHECKED) {
                flash('It need to be checked status');
                return back();
            }

            $books = $request->books;

            if ($books == null) {
                return $this->destroy($id);
            }

            //check books exist and customer used to buy it
            foreach ($books as $value) {
                $book = Book::find($value['id']);
                if ($book == null) {
                    $book = $this->book->withTrashed()->where('id', $value['id'])->get();
                    if ($book == null) {
                        flash('Book #' . $value['id'] . 'is not exist');
                        return back();
                    }
                    flash('Book ' . $book->name . 'was deleted');
                    return back();
                }

                $orderDetail = $this->orderDetail->where('order_id', $id)->where('book_id', $value['id'])->first();
                if ($orderDetail == null) {
                    flash('This Customer used not to buy it');
                    return back();
                }
            }

            // update orderDetail
            $orderDetails = $this->orderDetail->where('order_id', $id)->get();
            $books_id = array_column($books, 'quantity', 'id');
            foreach ($orderDetails as $orderDetail) {
                if (array_key_exists($orderDetail->book_id, $books_id)) {
                    $orderDetail->quantity = $books_id[$orderDetail->book_id];
                    $orderDetail->save();
                } else $orderDetail->delete();
            }

            // update order
            $orderDetails = $this->orderDetail->where('order_id', $id)->get();
            $sum = 0;
            foreach ($orderDetails as $orderDetail) {
                $sum += $orderDetail->sell_price * $orderDetail->quantity;
            }
            $order->total_price = $sum;
            $order->finished_id = Auth::id();
            $order->save();

            flash('Update succeed');
            return redirect()->back();
        }

        flash('You are not authorized');
        return back();
    }

    public function userUpdate(StoreOrderRequest $request, $id)
    {
        $order = $this->order->find($id);

        if ($order == null) {
            flash('Update failed(Order is not existed')->error();
            return back();
        }
        if ($order->user_id != Auth::id()) {
            flash('This is not your order')->error();
            return back();
        }
        if ($order->status >= Order::CONFIRM) {
            flash('Cant update this order')->warning();
            return back();
        }

        $request['aa'] = 'aa';
        $keys = ['name', 'phone', 'email', 'address', 'company'];
        $data = [];

        foreach ($keys as $key) {
            if (isset($request[$key])) {
                $data[$key] = $request[$key];
            }
        }
        $data['updated_at'] = now();

        $order->update($data);

        flash('Update succeed');
        return redirect()->route('carts.index');
    }

    /**
     * Check the order
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function check($id)
    {
        if (Gate::any(['admin', 'staff', 'seller'], Auth::user())) {

            $order = $this->order->find($id);
            if ($order == null) {
                flash('This order is not exist');
                return redirect()->back();
            }
            if ($order->status != Order::WAITING) {
                flash('Cant Check this order.It is ' . $order->status . ' status now');
                return redirect()->back();
            }

            $orderDetails = $this->orderDetail->where('order_id', $order->id)->get();
            $error = '';
            foreach ($orderDetails as $orderDetail) {
                if ($orderDetail->book == null) {
                    $error = 'Cant check(book is deleted)';
                    break;
                }
                if ($orderDetail->book->virtual_nums < $orderDetail->quantity) {
                    if ($error == null) {
                        $error = 'Not Enough Quantity:';
                    }
                    $error .= '\n\t' . $orderDetail->book->name . ' (' . $orderDetail->book->virtual_nums . '<' . $orderDetail->quantity . ')';
                }
            }
            if ($error != null) {
                flash($error)->error();
                return redirect()->back();
            }

            foreach ($orderDetails as $orderDetail) {
                $book = Book::find($orderDetail->book_id);
                $book->virtual_nums -= $orderDetail->quantity;
                $book->save();
            }

            $order->status = Order::CHECKED;
            $order->seller_id = Auth::id();
            $order->save();
            flash('You has checked Order#' . $order->id);
            return redirect()->back();
        }

        flash('You are not authorized')->warning();
        return redirect()->route('home');
    }

    /**
     * Seller request export to warehouseman
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function requestExport($id)
    {
        if (Gate::any(['admin', 'staff', 'seller'], Auth::user())) {
            $order = $this->order->find($id);
            if ($order == null) {
                flash('This order is not exist');
                return redirect()->back();
            }

            foreach ($order->orderdetails as $orderdetail) {
                if ($orderdetail->book == null) {
                    flash('Cant request(Book is deleted)')->warning();
                    return back();
                }
            }

            if ($order->status != Order::CHECKED) {
                flash('Cant request export this order.It is not checked status')->error();
                return redirect()->back();
            }

            $order->status = Order::REQUEST;
            $order->seller_id = Auth::id();
            $order->save();
            flash('Order#' . $order->id . ' is requesting export');
            return redirect()->back();
        }

        flash('You are not authorized')->warning();
        return redirect()->route('home');
    }

    /**
     * warehouse confirm exporting the order
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirmExport($id)
    {
        if (Gate::allows('warehouseman', Auth::user())) {
            $order = $this->order->find($id);
            if ($order == null) {
                flash('This order is not exist');
                return redirect()->back();
            }

            foreach ($order->orderdetails as $orderdetail) {
                if ($orderdetail->book == null) {
                    flash('Cant request(Book is deleted)')->warning();
                    return back();
                }
            }

            if ($order->status != Order::REQUEST) {
                flash('Cant confirm export this order.It is not request status')->error();
                return redirect()->back();
            }

            $orderDetails = $this->orderDetail->where('order_id', $order->id)->get();

            foreach ($orderDetails as $orderDetail) {
                $book = Book::find($orderDetail->book_id);
                $book->soluong -= $orderDetail->quantity;
                $book->save();
            }

            $order->status = Order::CONFIRM;
            $order->warehouseman_id = Auth::id();
            $order->save();

            flash('You confirmed exporting Order#' . $order->id);
            return redirect()->back();
        }

        flash('You are not authorized')->warning();
        return redirect()->route('home');
    }

    /**
     * take goods and shipping
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function shipping($id)
    {
        if (Gate::any(['admin', 'shipper'], Auth::user())) {

            $order = $this->order->find($id);
            if ($order == null) {
                flash('This order is not exist');
                return redirect()->back();
            }
            if ($order->status != Order::CONFIRM) {
                flash('Cant take this order.It is not confirm exported status')->error();
                return redirect()->back();
            }

            $order->status = Order::SHIPPING;
            $order->shipper_id = Auth::id();
            $order->save();
            flash('Order#' . $order->id . ' is shipping');
            return redirect()->back();
        }

        flash('You are not authorized')->warning();
        return redirect()->route('home');
    }

    /**
     * shipped and take money from customer
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function shipped($id)
    {
        if (Gate::any(['admin', 'shipper'], Auth::user())) {
            $order = $this->order->find($id);
            if ($order == null) {
                flash('This order is not exist');
                return redirect()->back();
            }
            if (Gate::allows('shipper', Auth::user()) && Auth::id() != $order->shipper_id) {
                flash('You are not authorized')->warning();
                return back();
            }

            if (Gate::allows('admin', Auth::user())) {
                $order->shipper_id = Auth::id();
            }

            $order->status = Order::SHIPPED;
            $order->updated_at = now();
            $order->save();
            flash('Order#' . $order->id . ' is shipped');
            return redirect()->back();
        }
    }

    /**
     * Finish the order and take money from shipper
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function done($id)
    {
        if (Gate::any(['admin', 'staff', 'seller'], Auth::user())) {

            $order = $this->order->find($id);
            if ($order == null) {
                flash('This order is not exist');
                return redirect()->back();
            }

            if ($order->status == Order::DONE) {
                flash('This order was done by ' . $order->finish->name);
                return redirect()->back();
            }

            if ($order->status != Order::SHIPPED) {
                flash('Cant finish this order.It is not shipped yet')->error();
                return redirect()->back();
            }

            $order->status = Order::DONE;
            $order->seller_id = Auth::id();
            $order->save();
            flash('You has been done Order#' . $order->id);
            return redirect()->back();
        }

        flash('You are not authorized')->warning();
        return redirect()->route('home');
    }


//    -------------------------------------------------------------------------------------

    /**
     * revert status: Checked->waiting
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function revertToWaiting($id)
    {
        if (Gate::any(['admin', 'staff'], Auth::user())) {

            $order = $this->order->find($id);
            if ($order == null) {
                flash('This order is not exist');
                return redirect()->back();
            }

            if ($order->status == Order::WAITING || $order->status == Order::SHIPPING || $order->status == Order::DONE) {
                flash('Cant convert to waiting.It is not checked status')->error();
                return redirect()->back();
            }

            $orderDetails = $this->orderDetail->where('order_id', $order->id)->get();

            foreach ($orderDetails as $orderDetail) {
                $book = Book::find($orderDetail->book_id);
                $book->virtual_nums += $orderDetail->quantity;
                $book->save();
            }

            $order->status = Order::WAITING;
            $order->save();
            flash('Revert Order#' . $order->id . ' successful');
            return redirect()->back();
        }

        flash('You are not authorized')->warning();
        return redirect()->route('home');
    }

    /**
     * revert status: request -> checked
     * @param $id : order_id
     * @return back()
     */
    public function revertToChecked($id)
    {
        if (Gate::any(['admin', 'staff'], Auth::user())) {
            $order = $this->order->find($id);
            if ($order == null) {
                flash('This order is not exist');
                return redirect()->back();
            }
            if ($order->status != Order::REQUEST) {
                flash('Cant revert this order.It is not ' . Order::REQUEST . ' status')->error();
                return redirect()->back();
            }

            $order->status = Order::CHECKED;
            $order->save();
            flash('Revert to checked successful');
            return redirect()->back();
        }

        flash('You are not authorized')->error();
        return redirect()->back();
    }

//----------------------------------------------------------------------------------------------

    /**
     * user cancel order
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel($id)
    {
        $order = $this->order->find($id);
        if ($order == null) {
            flash("This order is not existed")->error();
            return back();
        }

        if ($order->user_id != Auth::id()) {
            flash('This is not your order')->error();
            return back();
        }

        if ($order->status >= Order::CONFIRM) {
            flash('Cancel failed.This order is already exported')->error();
            return back();
        }

        if ($order->status >= Order::CHECKED) {
            foreach($order->orderdetails as $orderdetail)
            {
                $book = Book::withTrashed()->find($orderdetail->book_id);
                $book->virtual_nums += $orderdetail->quantity;
                $book->save();
            }
        }

        if ($order->pay_status == true) {
            if ($order->payback == true) {
                flash('Something went wrong.Please contact to admin for more detail ')->warning();
                return redirect()->route('carts.index');
            }

            // MoMo
            if ($order->payment == 'MoMo') {
                $response = \MoMoAIO::refund([
                    'orderId' => $order->id,
                    'requestId' => $order->id,
                    'transId' => $order->transId,
                    'amount' => 0.9 * 20000 * $order->amount,
                ])->send();

                if ($response->isSuccessful()) {
                    $order->payback = true;
                    $order->delete();
                    flash('Cancel Order#' . $order->id . ' succeed');
                    return back();
                } else {
                    flash($response->getMessage())->error();
                    return back();
                }
            }

            // VNPay
            if ($order->payment == 'VNPay') {
                flash('Cant payback by VNPay ')->warning();
                return redirect()->route('carts.index');
            }

            if ($order->payment == 'point') {
                $order->payback = true;
                $order->delete();
                $user = Auth::user();
                $user->point += ceil(0.9 * $order->total_price * 10) / 10;
                $user->save();
                flash('Cancel Order successful')->warning();
                return back();
            }

            flash('Something went wrong!Please contact to admin')->warning();
            return back();
        } else {
            //offline
            $order->delete();
            flash('Cancel Order#' . $order->id . ' succeed');
            return back();
        }
    }

//    ---------------------------- returns request ---------------------------------

    public function createReturnsRequest($id)
    {
        $order = $this->order->find($id);
        if ($order == null) {
            flash("This Order is not existed");
            return back();
        }

        if ($order->user_id != Auth::id()) {
            flash('This is not your order');
            return back();
        }

        if (!($order->status == Order::DONE || $order->status == Order::SHIPPED)) {
            flash('Cant create returns request.');
            return back();
        }

        if ($order->returns_request != Order::NO_RETURNS) {
            flash('This order has been created returns request');
            return back();
        }

        $limit = 8; //time limit(hour)

        if (strtotime('now') >= (strtotime($order->updated_at) + $limit * 60 * 60)) {
            flash('This order has been out of date to create returns request');
            return back();
        }


        $order->returns_request = Order::HAS_RETURNS;
        $order->save();

        flash('Create returns request successful');
        return back();
    }

    public function cancelReturnsRequest($order_id)
    {
        $order = $this->order->find($order_id);
        if ($order == null) {
            flash('This Order is not existed');
            return back();
        }

        if ($order->status == Order::SHIPPED || $order->status == Order::DONE) {
            if ($order->returns_request != Order::HAS_RETURNS) {
                flash('This order doesnt have returns request.');
                return back();
            }

            $order->returns_request = Order::NO_RETURNS;
            $order->save();

            flash('Cancel successful');
            return back();
        }


        flash('This Order is not Shipped or Done');
        return back();
    }


    public function acceptReturnsRequest($order_id)
    {
        $order = $this->order->find($order_id);
        if ($order == null) {
            flash('This Order is not existed');
            return back();
        }

        if ($order->status == Order::SHIPPED || $order->status == Order::DONE) {
            if ($order->returns_request != Order::HAS_RETURNS) {
                flash('This order doesnt have returns request.');
                return back();
            }

            $order->returns_request = Order::ACCEPTED_RETURNS;
            $order->save();

            flash('Accepted successful');
            return back();
        }


        flash('This Order is not Shipped or Done');
        return back();
    }

    public function deniesReturnsRequest($order_id)
    {
        $order = $this->order->find($order_id);
        if ($order == null) {
            flash('This Order is not existed');
            return back();
        }

        if ($order->status == Order::SHIPPED || $order->status == Order::DONE) {
            if ($order->returns_request != Order::HAS_RETURNS) {
                flash('This order doesnt have returns request.');
                return back();
            }

            $order->returns_request = Order::DENIES_RETURNS;
            $order->save();

            flash('Denies successful');
            return back();
        }


        flash('This Order is not Shipped or Done');
        return back();
    }

    public function returnsRequestsList()
    {
        if (!Gate::any(['admin', 'staff', 'seller'], Auth::user())) {
            flash('You are not authorized')->warning();
            return back();
        }

        $status_arr = [Order::SHIPPED, Order::DONE];
        $returns_arr = [Order::HAS_RETURNS, Order::ACCEPTED_RETURNS, Order::DENIES_RETURNS];

        $orders = $this->order->withTrashed()->whereIn('returns_request', $returns_arr)->whereIn('status', $status_arr)->paginate();
        return view('returnsRequests.index')->with('orders', $orders);
    }


    /**
     * Cancel order (function of manager)
     * seller when checked status
     * admin,staff when before
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::any(['admin', 'staff', 'seller'], Auth::user())) {
            $order = $this->order->find($id);
            if ($order == null) {
                flash("This order is not existed")->error();
                return back();
            }

            if ($order->status == Order::DONE) {
                flash('Cant cancel this order.It is Done')->error();
                return back();
            }
            if ($order->status == Order::CANCEL_AFTER_EXPORT) {
                flash('This order is ' . Order::$status[$order->status] . ' now')->warning();
                return back();
            }

            if ($order->status < Order::CONFIRM) {
                $order->seller_id = Auth::id();
                $order->save();

                $orderDetails = $this->orderDetail->where('order_id', $order->id)->get();

                foreach ($orderDetails as $orderDetail) {
                    $book = Book::find($orderDetail->book_id);
                    $book->virtual_nums += $orderDetail->quantity;
                    $book->save();
                }

                $order->delete();
                flash('Order #' . $id . 'is canceled');
                return redirect()->route('orders.index');
            }

            $order->status = Order::CANCEL_AFTER_EXPORT;
            $order->seller_id = Auth::id();
            $order->save();
            flash('This order is ' . Order::$status[$order->status] . ' now');
            return back();
        }

        flash('You are not authorized')->error();
        return redirect()->back();
    }

    /**
     * confirm tack back books after canceled
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirmTakeBackBooks($id)
    {
        if (Gate::allows('warehouseman', Auth::user())) {
            $order = $this->order->find($id);
            if ($order == null) {
                flash('This order is not exist');
                return redirect()->route('orders.index');
            }

            if ($order->status != Order::CANCEL_AFTER_EXPORT) {
                flash('Cant confirm tack back books.It is not Cancel status');
                return back();
            }

            $orderDetails = $this->orderDetail->where('order_id', $order->id)->get();

            foreach ($orderDetails as $orderDetail) {
                $book = Book::find($orderDetail->book_id);
                $book->soluong += $orderDetail->quantity;
                $book->save();
            }

            $order->warehouse1_id = Auth::id();
            $order->delete();

            flash('You confirmed take back books and finish Order#' . $order->id);
            return redirect()->back();
        }
    }
}
