<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Orderdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $book;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $b0 = Orderdetail::groupBy('book_id')->orderByRaw('sum(quantity) desc')->limit(10)->get()->pluck('book');

        $id = $this->book->findLoaisach(11)->pluck('id');
        $b1 = Orderdetail::whereIn('book_id', $id)->groupBy('book_id')->orderByRaw('sum(quantity) desc')->limit(10)->get()->pluck('book');

        $id = $this->book->findLoaisach(12)->pluck('id');
        $b2 = Orderdetail::whereIn('book_id', $id)->groupBy('book_id')->orderByRaw('sum(quantity) desc')->limit(10)->get()->pluck('book');

        $id = $this->book->findLoaisach(13)->pluck('id');
        $b3 = Orderdetail::whereIn('book_id', $id)->groupBy('book_id')->orderByRaw('sum(quantity) desc')->limit(10)->get()->pluck('book');

        $id = $this->book->findLoaisach(14)->pluck('id');
        $b4 = Orderdetail::whereIn('book_id', $id)->groupBy('book_id')->orderByRaw('sum(quantity) desc')->limit(10)->get()->pluck('book');

        $best_books = Orderdetail::groupBy('book_id')->orderByRaw('sum(quantity) desc')->limit(7)->get()->pluck('book');

        return view('home')->with(['b0' => $b0, 'b1' => $b1, 'b2' => $b2, 'b3' => $b3, 'b4' => $b4, 'best_books' => $best_books]);
    }
}
