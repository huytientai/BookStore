<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Orderdetail;
use App\Models\tacgia;

class HomeController extends Controller
{
    protected $book;
    protected $orderdetail;
    protected $tacgia;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Book $book, Orderdetail $orderdetail, tacgia $tacgia)
    {
        $this->book = $book;
        $this->orderdetail = $orderdetail;
        $this->tacgia = $tacgia;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $b0 = $this->orderdetail->groupBy('book_id')->orderByRaw('sum(quantity) desc')->limit(10)->get()->pluck('book');

        $id = $this->book->findLoaisach(11)->pluck('id');
        $b1 = $this->orderdetail->whereIn('book_id', $id)->groupBy('book_id')->orderByRaw('sum(quantity) desc')->limit(10)->get()->pluck('book');

        $id = $this->book->findLoaisach(12)->pluck('id');
        $b2 = $this->orderdetail->whereIn('book_id', $id)->groupBy('book_id')->orderByRaw('sum(quantity) desc')->limit(10)->get()->pluck('book');

        $id = $this->book->findLoaisach(13)->pluck('id');
        $b3 = $this->orderdetail->whereIn('book_id', $id)->groupBy('book_id')->orderByRaw('sum(quantity) desc')->limit(10)->get()->pluck('book');

        $id = $this->book->findLoaisach(14)->pluck('id');
        $b4 = $this->orderdetail->whereIn('book_id', $id)->groupBy('book_id')->orderByRaw('sum(quantity) desc')->limit(10)->get()->pluck('book');

        $tacgias=$this->book->groupBy('tacgia_id')->orderByRaw('count(*) desc')->limit(3)->get()->pluck('tacgia');

        $best_books = $this->orderdetail->groupBy('book_id')->orderByRaw('sum(quantity) desc')->limit(7)->get()->pluck('book');

        return view('home')->with(['b0' => $b0, 'b1' => $b1, 'b2' => $b2, 'b3' => $b3, 'b4' => $b4, 'tacgias' => $tacgias, 'best_books' => $best_books]);
    }
}
