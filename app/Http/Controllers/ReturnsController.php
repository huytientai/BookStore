<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Returns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $orders = $this->order->has('returns')->paginate();
        return view('returns.index')->with('orders', $orders);
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

    public function check($order_id)
    {
        $order = $this->order->find($order_id);
        if ($order == null || $order->returns == null) {
            flash('This returns is not existed');
            return back();
        }

        if ($order->returns->status != Returns::WAITING) {
            flash('It is not waitting status right now')->warning();
            return back();
        }

        $returns = $this->returns->find($order_id);
        $returns->status = Returns::CHECKED;
        $returns->save();

        flash('Checked succeed');
        return back();
    }

    public function done($order_id)
    {
        $order = $this->order->find($order_id);
        if ($order == null || $order->returns == null) {
            flash('This returns is not existed');
            return back();
        }

        if ($order->returns->status != Returns::CHECKED) {
            flash('It is not waitting status right now')->warning();
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
