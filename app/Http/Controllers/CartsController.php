<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartsController extends Controller
{
    protected $cart;
    protected $order;
    protected $book;


    public function __construct(Cart $cart, Order $order, Book $book)
    {
        $this->cart = $cart;
        $this->order = $order;
        $this->book = $book;
    }

    /**
     * Display cart of an user
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = $this->cart->where('user_id', Auth::id())->orderBy('id')->get();
        $orders = $this->order->withTrashed()->with(['orderdetails' => function ($query) {
            $query->with(['book' => function ($query) {
                $query->withTrashed();
            }]);
        }])->where('user_id', Auth::id())->where('status', '!=', Order::DONE)->where('status', '!=', Order::SHIPPED)->orderBy('status')->orderBy('created_at', 'desc')->get();

        return view('carts.index')->with(['carts' => $carts, 'orders' => $orders]);
    }


    /**
     * Store book into cart in books.show page
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!isset($request->book_id)) {
            flash('Error. Please try again!')->error();
            return redirect()->back();
        }
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

        $this->cart->removeCartOfUser();

        if ($books != null) {
            foreach ($books as $value) {
                $book = $this->book->find($value['id']);
                $data['user_id'] = Auth::id();
                $data['book_id'] = $book->id;
                $data['quantity'] = $value['quantity'];
                $this->cart->create($data);
            }
        }
        flash('Update success')->success();
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
