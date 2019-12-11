<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
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
    public function index()
    {
        $carts = $this->cart->where('user_id', Auth::id())->orderBy('id')->get();
        $order = $this->order->where('user_id', Auth::id())->where('status', false)->orderBy('created_at', 'desc')->first();

        if ($order != null) {
            $orderdetails = $this->orderdetail->where('order_id', $order->id)->get();
        } else {
            $orderdetails = null;
        }

        return view('carts.index')->with(['carts' => $carts, 'order' => $order, 'orderdetails' => $orderdetails]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->cart->saveCart($request)) {
            return redirect()->route('carts.index');
        } else {
            flash('Da ton tai trong gio')->success();
            return redirect()->back();
        }
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
     * order
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $books = $request->books;

        $total = 0;
        foreach ($books as $value) {
            $book = $this->book->find($value['id']);
            $total += $book->price * $value['quantity'];
        }
        $order = $this->order->create(['user_id' => Auth::id(), 'total_price' => $total]);

        foreach ($books as $value) {
            $book = $this->book->find($value['id']);
            $data['order_id'] = $order->id;
            $data['book_id'] = $book->id;
            $data['sell_price'] = $book->price;
            $data['quantity'] = $value['quantity'];
            $this->orderdetail->create($data);
        }

        $this->cart->removeCartOfUser();

        flash('Dat hang thanh cong')->success();
        return redirect()->route('carts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
        $this->cart->find($id)->delete();

        flash('delete success')->error();

        return redirect()->route('carts.index');
    }
}
