<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Returns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ReturnsController extends Controller
{
    protected $order;
    protected $returns;

    public function __construct(Order $order, Returns $returns)
    {
        $this->order = $order;
        $this->returns = $returns;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::any(['admin', 'staff', 'seller', 'warehouseman'], Auth::user())) {
            $orders = $this->order->has('returns')->paginate();
            return view('returns.index')->with('orders', $orders);
        }
        flash('you are not authorized');
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $order_id = $request->order_id;
        if ($order_id == null) {
            flash('Something error!Please try again.');
            return back();
        }

        $returns = $this->returns->find($order_id);
        if ($returns) {
            flash('Returns is existed');
            return back();
        }

        $order = $this->order->find($order_id);
        if ($order == null) {
            flash('This order is not existed');
            return back();
        }

        if ($order->user_id != Auth::user()->id) {
            flash('It is not your order');
            return back();
        }

        if ($order->returns_request != Order::ACCEPTED_RETURNS) {
            flash('Cant send ship info');
            return back();
        }

        return view('returns.create')->with('order_id', $order_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order_id = $request->order_id;
        if ($order_id == null) {
            flash('Something error!Please try again.');
            return back();
        }

        $returns = $this->returns->find($order_id);
        if ($returns) {
            flash('Returns is existed');
            return back();
        }

        $order = $this->order->find($order_id);
        if ($order == null) {
            flash('This order is not existed');
            return back();
        }

        if ($order->user_id != Auth::user()->id) {
            flash('It is not your order');
            return back();
        }

        if ($order->returns_request != Order::ACCEPTED_RETURNS) {
            flash('Cant send ship info');
            return back();
        }

        $returns = $this->returns->saveReturns($request);
        $order->returns_request = Order::SENT_RETURNS;
        $order->save();

        flash('Send successful');
        return redirect()->route('returns.user_list');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order_id = $id;
        if ($order_id == null) {
            flash('Something error!Please try again.');
            return back();
        }

        $returns = $this->returns->find($order_id);
        if ($returns == null) {
            flash('Returns is not exist');
            return back();
        }

        $order = $this->order->find($order_id);
        if ($order == null) {
            flash('This order is not existed');
            return back();
        }

        if ($order->user_id != Auth::user()->id) {
            flash('It is not your order');
            return back();
        }

        if ($returns->status > Returns::CHECKED) {
            flash('Cant edit this returns info');
            return back();
        }

        return view('returns.edit')->with(['order_id' => $order_id, 'returns' => $returns]);
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
        $order_id = $id;
        if ($order_id == null) {
            flash('Something error!Please try again.');
            return back();
        }

        $returns = $this->returns->find($order_id);
        if ($returns == null) {
            flash('Returns is not exist');
            return back();
        }

        $order = $this->order->find($order_id);
        if ($order == null) {
            flash('This order is not existed');
            return back();
        }

        if ($order->user_id != Auth::user()->id) {
            flash('It is not your order');
            return back();
        }

        if ($returns->status > Returns::CHECKED) {
            flash('Cant edit this returns info');
            return back();
        }

        $this->returns->updateReturns($request);

        flash('Update succeed');
        return redirect()->route('users.show', Auth::id());
    }


//    --------------------------- manager ----------------------------

    public function check($order_id)
    {
        if (!Gate::any(['admin', 'staff', 'seller'], Auth::user())) {
            flash('you are not authorized');
            return redirect()->route('home');
        }

        $order = $this->order->find($order_id);
        if ($order == null || $order->returns == null) {
            flash('This returns is not existed');
            return back();
        }

        if ($order->returns->status != Returns::WAITING) {
            flash('It is not waiting status right now')->warning();
            return back();
        }

        $returns = $this->returns->find($order_id);
        $returns->status = Returns::CHECKED;
        $returns->save();

        flash('Checked succeed');
        return back();
    }

    public function requestWarehouseman($order_id)
    {
        if (!Gate::any(['admin', 'staff', 'seller'], Auth::user())) {
            flash('you are not authorized');
            return redirect()->route('home');
        }

        $order = $this->order->find($order_id);
        if ($order == null || $order->returns == null) {
            flash('This returns is not existed');
            return back();
        }

        if ($order->returns->status != Returns::CHECKED) {
            flash('It is not Checked status right now')->warning();
            return back();
        }

        $returns = $this->returns->find($order_id);
        $returns->status = Returns::REQUEST;
        $returns->save();

        flash('Requested succeed');
        return back();
    }

    public function ConfirmFromWarehouseman($order_id)
    {
        if (Gate::denies('warehouseman', Auth::user())) {
            flash('you are not authorized')->warning();
            return redirect()->back();
        }

        $order = $this->order->find($order_id);
        if ($order == null || $order->returns == null) {
            flash('This returns is not existed');
            return back();
        }

        if ($order->returns->status != Returns::REQUEST) {
            flash('It is not Requested status right now')->warning();
            return back();
        }

        $returns = $this->returns->find($order_id);
        $returns->status = Returns::CONFIRM;
        $returns->warehouseman_id = Auth::id();
        $returns->save();

//        $books = $order->orderDet

        flash('Confirmed succeed');
        return back();
    }

    public function done($order_id)
    {
        if (!Gate::any(['admin', 'staff', 'seller'], Auth::user())) {
            flash('you are not authorized');
            return redirect()->route('home');
        }

        $order = $this->order->find($order_id);
        if ($order == null || $order->returns == null) {
            flash('This returns is not existed');
            return back();
        }

        if ($order->returns->status != Returns::CONFIRM) {
            flash('It is not Confirm status from warehouseman right now')->warning();
            return back();
        }

        $order->returns_request = Order::DONE_RETURNS;
        $order->save();

        $returns = $this->returns->find($order_id);
        $returns->status = Returns::DONE;
        $returns->save();

        flash('Done succeed');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::any(['admin', 'staff', 'seller'], Auth::user())) {
            flash('you are not authorized');
            return redirect()->route('home');
        }

        $returns = $this->returns->find($id);
        if ($returns == null) {
            flash('This returns is not existed');
            return back();
        }

        $returns->delete();
        flash('Cancelled succeed');
        return back();
    }
}
