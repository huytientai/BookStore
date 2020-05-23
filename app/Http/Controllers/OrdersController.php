<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\Orderdetail;
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
        if (Gate::any(['admin', 'staff', 'seller'], Auth::user())) {
            $orders = $this->searchOrders($request->all());

            return view('orders.index')->with('orders', $orders);
        }

        flash('you are not authorized');
        return redirect()->back();
    }

    public function searchOrders($data)
    {
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
     * Show the form for editing the order after checked.
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

            if ($order->status == Order::CHECKED) {
                return view('orders.edit')->with('order', $order);
            }

            flash('Cant edit this order');
            return back();
        }

        flash('You are not authorized');
        return redirect()->back();
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
        if (Gate::any(['admin', 'staff', 'warehouse'], Auth::user())) {
            $order = $this->order->find($id);
            if ($order == null) {
                flash('This order is not exist');
                return redirect()->back();
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
        if (Gate::any(['admin', 'staff', 'shipper'], Auth::user())) {

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

            $order->status = Order::SHIPPING;
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
     * Cancel order
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
                flash("This order is not existed");
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
