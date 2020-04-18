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
        $books = $request->books;

        $total = 0;
        // create order
        foreach ($books as $value) {
            $book = $this->book->find($value['id']);
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

        flash('Order Successed')->success();
        return redirect()->route('carts.index');
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
