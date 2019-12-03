<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

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
        $b1 = $this->book->findLoaisach(11)->get();
//        $b2 = $this->book->findLoaisach(12)->get();
//        $b3 = $this->book->findLoaisach(13)->get();
//        $b4 = $this->book->findLoaisach(14)->get();

        return view('home')->with(['b1' => $b1]);
    }
}
