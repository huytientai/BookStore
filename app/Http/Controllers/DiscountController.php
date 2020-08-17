<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiscount;
use App\Models\Discount;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
        if (!Gate::any(['admin', 'staff', 'seller'], Auth::user())) {
            flash("You are not authorized")->warning();
            return back();
        }
        $discounts = $this->discount->withTrashed()->paginate();
        return view('discount.index')->with('discounts', $discounts);
    }

    public function show($id)
    {
        $discount = $this->discount->withTrashed()->find($id);

        if ($discount == null) {
            flash('This code is not existed')->warning();
            return back();
        }

        return view('discount.show')->with(['discount' => $discount]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::any(['admin', 'staff'], Auth::user())) {
            flash("You are not authorized")->warning();
            return back();
        }

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
        if (!Gate::any(['admin', 'staff'], Auth::user())) {
            flash("You are not authorized")->warning();
            return back();
        }

        $this->discount->saveDiscount($request);

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
        if (!Gate::any(['admin', 'staff'], Auth::user())) {
            flash("You are not authorized")->warning();
            return back();
        }

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
        if (!Gate::any(['admin', 'staff'], Auth::user())) {
            flash("You are not authorized")->warning();
            return back();
        }

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
        if (!Gate::any(['admin', 'staff'], Auth::user())) {
            flash("You are not authorized")->warning();
            return back();
        }

        $discount = $this->discount->find($id);
        if ($discount == null) {
            flash('This code is not existed')->warning();
            return back();
        }

        $discount->delete();
        flash('Deleted code ' . $discount->code . ' successfully');
        return back();
    }

    public function checkCode(Request $request)
    {
        if (!isset($request->code)) {
            return ;
        }

        $discount = $this->discount->where('code', $request->code)->first();

        if (empty($discount)) {
            return ;
        }

        $xmlDocument = new \DOMDocument('1.0');
        $xmlDocument->preserveWhiteSpace = false;
        $xmlDocument->formatOutput = true;

        $element = $xmlDocument->createElement('coupon_code');
        $xmlDocument->appendChild($element);

        $element1 = $xmlDocument->createElement('code', $discount->code);
        $element->appendChild($element1);
        $element1 = $xmlDocument->createElement('discount', $discount->discount);
        $element->appendChild($element1);
        $element1 = $xmlDocument->createElement('start_time', $discount->start_time);
        $element->appendChild($element1);
        $element1 = $xmlDocument->createElement('end_time', $discount->end_time);
        $element->appendChild($element1);
        $element1 = $xmlDocument->createElement('price_condition', $discount->price_condition);
        $element->appendChild($element1);
        $element1 = $xmlDocument->createElement('num_condition', $discount->num_condition);
        $element->appendChild($element1);
        
        echo $xmlDocument->saveXML();

        return;
    }
}
