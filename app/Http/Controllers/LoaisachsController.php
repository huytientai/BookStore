<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loaisach;
use Illuminate\Http\Request;

class LoaisachsController extends Controller
{
    protected $loaisach;

    public function __construct(Loaisach $loaisach)
    {
        $this->loaisach = $loaisach;
        $this->middleware(['auth','manager'])->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loaisachs = $this->loaisach->orderBy('name')->paginate();
        return view('loaisachs.index')->with('loaisachs', $loaisachs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('loaisachs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->loaisach->saveLoaisach($request);

        flash('add success')->success();

        return redirect()->route('loaisachs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loaisach = $this->loaisach->find($id);
        $loaisachs = $this->loaisach->allLoaisachCount();
        $book = new Book();
        $books = $book->findLoaisach($id)->paginate(12);
        return view('loaisachs.show')->with(['main_loaisach' => $loaisach, 'books' => $books,'loaisachs' => $loaisachs]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $loaisach = $this->loaisach->find($id);
        return view('loaisachs.edit')->with('loaisach', $loaisach);
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
        $this->loaisach->updateLoaisach($request);

        flash('update success')->success();

        return redirect()->route('loaisachs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->loaisach->find($id)->delete();

        flash('delete success')->error();

        return redirect()->route('loaisachs.index');
    }
}
