<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\StoreImportRequest;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Import;
use App\Models\Loaisach;
use App\Models\TableOfContents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BooksController extends Controller
{
    protected $book;
    protected $loaisach;
    protected $import;
    protected $tableOfContents;

    public function __construct(Book $book, Loaisach $loaisach, Import $import, TableOfContents $tableOfContents)
    {
        $this->book = $book;
        $this->loaisach = $loaisach;
        $this->import = $import;
        $this->tableOfContents = $tableOfContents;
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
        if (Gate::any(['admin', 'staff'], Auth::user())) {
            return view('books.create');
        }
        return redirect()->route('home');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookRequest $request)
    {
        if (Gate::none(['admin', 'staff'], Auth::user())) {
            return redirect()->route('books.index');
        }
        $book = $this->book->saveBook($request);
        $this->tableOfContents->saveTableOfContents($request,$book->id);

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
        if ($book == null) {
            flash('This book is not existed');
            return redirect()->route('home');
        }

        $contents = $this->tableOfContents->where('book_id', $id)->get();
        return view('books.show')->with(['book' => $book, 'contents' => $contents, 'loaisachs' => $loaisachs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::any(['admin', 'staff'], Auth::user())) {
            $book = $this->book->find($id);
            if ($book == null) {
                flash('This book is not exist');
                return redirect()->route('home');
            }

            $contents = $this->tableOfContents->where('book_id', $id)->get();

            return view('books.edit')->with(['book' => $book, 'contents' => $contents]);
        }
        return redirect()->route('books.show', $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBookRequest $request)
    {
        if (Gate::none(['admin', 'staff'], Auth::user())) {
            return redirect()->route('books.show', $request->id);
        }

        if (!isset($request->id) || !$this->book->find($request->id)) {
            flash('This book is not existed');
            return back();
        }

        $this->book->updateBook($request);
        $this->tableOfContents->updateTableOfContents($request);

        flash('update success')->success();
        return redirect()->route('books.show', $request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::none(['admin', 'staff'], Auth::user())) {
            return redirect()->route('books.show', $id);
        }

        $book = $this->book->find($id);

        if ($book == null) {
            flash('This book is not exist');
            return back();
        }

        //delete if relationship
        Favorite::where('book_id', $id)->delete();
        Cart::where('book_id', $id)->delete();

        $book->delete();
        flash('delete success')->error();
        return redirect()->route('books.index');
    }

    public function storeImportRequest(StoreImportRequest $request, $book_id)
    {
        if (!Gate::any(['admin', 'staff', 'warehouseman'], Auth::user())) {
            return redirect()->route('books.show', $book_id);
        }

        $data = $request->all();
        $data['book_id'] = $book_id;
        $data['user_id'] = Auth::id();
        $data['status'] = 0;
        $data['accepted_id'] = 1;

        $this->import->create($data);

        flash('Send import request succeeded');
        return redirect()->route('books.show', $book_id);
    }
}
