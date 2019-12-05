<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{
    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = $this->cart->where('user_id', Auth::id())->orderBy('id')->get();
        return view('carts.index')->with('carts', $carts);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Add book into cart by short-way
     *
     * @param int $book_id
     * @return \Illuminate\Http\Response
     */
    public function show($book_id)
    {
        $x = $this->cart->quickAddToCart($book_id);
        if (!$x) {
            flash('Cannot add this book')->error();
            return redirect()->back();
        }

        if ($x == 2) {
            flash('Sach da co trong gio');
            return redirect()->back();
        }

        if ($x == 1) {
            flash('Da them sach vao gio');
            return redirect()->back();
        }

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
