<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\StoreImportRequest;
use App\Models\Book;
use App\Models\Import;
use App\Models\Loaisach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class BooksController extends Controller
{
    protected $book;
    protected $loaisach;
    protected $import;

    public function __construct(Book $book, Loaisach $loaisach, Import $import)
    {
        $this->book = $book;
        $this->loaisach = $loaisach;
        $this->import = $import;
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
        if (Gate::any(['admin', 'staff'], Auth::user())) {
            $book = $this->book->find($id);
            return view('books.edit')->with('book', $book);
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

        $this->book->updateBook($request);

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

        $this->book->find($id)->delete();

        flash('delete success')->error();
        return redirect()->route('books.index');
    }

    public function storeImportRequest(StoreImportRequest $request, $book_id)
    {
        if (!Gate::any(['admin', 'staff', 'warehouseman'], Auth::user())) {
            return redirect()->route('books.show', $book_id);
        }

        $data = $request->all();
        $data['book_id']=$book_id;
        $data['user_id']=Auth::id();
        $data['status'] = 0;
        $data['accepted_id'] = 1;

        $this->import->create($data);

        flash('Send import request succeeded');
        return redirect()->route('books.show', $book_id);
    }
}
