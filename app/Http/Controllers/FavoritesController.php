<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    protected $favorite;
    protected $book;

    public function __construct(Favorite $favorite, Book $book)
    {
        $this->favorite = $favorite;
        $this->book = $book;

    }

    /**
     * Display a favorites List of an User.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $favorites = $this->favorite->where('user_id', Auth::id())->orderBy('created_at')->get();
        return view('favorites.index')->with('favorites', $favorites);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * add book to favorite
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = $this->book->find($id);
        if ($book == null) {
            flash('This book is not existed');
            return back();
        }

        $favorite['user_id'] = Auth::id();
        $favorite['book_id'] = $id;
        $this->favorite->create($favorite);
        flash('Add book to favorite successful');
        return back();
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
    public function destroy($book_id)
    {
        $favorite = $this->favorite->where('user_id', Auth::id())->where('book_id', $book_id)->get();
        if ($favorite == null) {
            flash('This book has not been added to the favorites yet');
            return back();
        }
        $this->favorite->where('user_id', Auth::id())->where('book_id', $book_id)->delete();
        flash('Delete successful');
        return back();
    }

}
