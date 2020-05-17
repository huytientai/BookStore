<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\tacgia;
use Illuminate\Http\Request;

class TacgiasController extends Controller
{
    protected $tacgia;

    public function __construct(tacgia $tacgia)
    {
        $this->tacgia = $tacgia;
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$tacgias = $this->tacgia->orderBy('name')->paginate();
        return view('tacgias.index')->with('tacgias', $tacgias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('tacgias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		$this->tacgia->saveTacgia($request);

        flash('add success')->success();

        return redirect()->route('tacgias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
		$tacgia = $this->tacgia->find($id);
        $book = new Book();
        $books = $book->findTacgia($id)->paginate();
        return view('tacgias.show')->with(['tacgia' => $tacgia, 'books' => $books]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$tacgia = $this->tacgia->find($id);
        return view('tacgias.edit')->with('tacgia', $tacgia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
		$this->tacgia->updateTacgia($request);

        flash('update success')->success();

        return redirect()->route('tacgias.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$author=$this->tacgia->withCount('books')->find($id);

        if ($author == null) {
            flash('This author is not exited')->error();
            return redirect()->route('tacgias.index');
        }

        if ($author->books_count) {
            flash('Cannot delete(' . $author->books_count . ' books exist)')->error();
            return back();
        }

		$author->delete();

        flash('delete successful')->error();

        return redirect()->route('tacgias.index');
    }
}
