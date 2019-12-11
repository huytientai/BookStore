<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use App\Models\Loaisach;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    protected $book;
    protected $loaisach;

    public function __construct(Book $book, Loaisach $loaisach)
    {
        $this->book = $book;
        $this->loaisach = $loaisach;
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $loaisachs = $this->loaisach->allLoaisachCount();
        if ($request->all() == null) {
            $books = $this->book->orderBy('name')->paginate(12);
        } else {
            $books = $this->book->searchBook($request->all());
        }
        return view('books.index')->with(['books' => $books, 'loaisachs' => $loaisachs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        $this->book->saveBook($request);

        flash('add success')->success();

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loaisachs = $this->loaisach->allLoaisachCount();
        $book = $this->book->find($id);
        return view('books.show')->with(['book' => $book, 'loaisachs' => $loaisachs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = $this->book->find($id);
        return view('books.edit')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->book->updateBook($request);

        flash('update success')->success();

        return redirect()->route('books.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->book->find($id)->delete();

        flash('delete success')->error();

        return redirect()->route('books.index');
    }
}
