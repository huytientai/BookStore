<?php

namespace App\Http\Controllers;

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
        $builder = $this->order->orderBy('status')->orderBy('created_at', 'desc')->orderBy('id', 'desc');
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

        return $builder->paginate();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $order = $this->order->find($id);
        if ($order == null) {
            flash('This order is not exist');
            return redirect()->back();
        }

        $books = $request->books;


        $orderDetails = $this->orderDetail->where('order_id', $id)->get();
        $sum = 0;
        foreach ($orderDetails as $orderDetail) {
            $sum += $orderDetail->sell_price * $orderDetail->quantity;
        }
        $order->sum = $sum;

        flash('Update succeed');
        return redirect()->back();

    }

    /** Accept and finish the order
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function finish($id)
    {
        if (Gate::any(['admin', 'staff', 'seller'], Auth::user())) {

            $order = $this->order->find($id);
            if ($order == null) {
                flash('This order is not exist');
                return redirect()->back();
            }
            if ($order->status == true) {
                flash('This order was finished by ' . $order->user->name);
                return redirect()->back();
            }
            $order->status = true;
            $order->save();
            flash('You has been finished Order#' . $order->id);
            return redirect()->back();
        }

        flash('You are not authorized');
        return redirect()->route('home');
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
