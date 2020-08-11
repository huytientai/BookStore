<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiscount;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    protected $discount;

    public function __construct(Discount $discount)
    {
        $this->discount = $discount;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = $this->discount->paginate();
        return view('discount.index')->with('discounts', $discounts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('discount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscount $request)
    {
        $this->discount->create($request->all());

        flash('Created succeeded');
        return redirect()->route('discount.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discount = $this->discount->find($id);

        if ($discount == null) {
            flash('This discount code is not existed')->warning();
            return back();
        }

        return view('discount.edit')->with('discount', $discount);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDiscount $request, $id)
    {
        $this->discount->find($id)->update($request->all());
        flash('Update succeeded');
        return redirect()->route('discount.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
