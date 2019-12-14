<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Nhaxuatban;
use Illuminate\Http\Request;

class NhaxuatbansController extends Controller
{
    protected $nhaxuatban;

    public function __construct(Nhaxuatban $nhaxuatban)
    {
        $this->nhaxuatban = $nhaxuatban;
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
        $nhaxuatbans = $this->nhaxuatban->orderBy('name')->paginate();
        return view('nhaxuatbans.index')->with('nhaxuatbans', $nhaxuatbans);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('nhaxuatbans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->nhaxuatban->saveNhaxuatban($request);

        flash('add success')->success();

        return redirect()->route('nhaxuatbans.index');
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $nhaxuatban = $this->nhaxuatban->find($id);
        $book = new Book();
        $books = $book->findNhaxuatban($id)->paginate();
        return view('nhaxuatbans.show')->with(['nhaxuatban' => $nhaxuatban, 'books' => $books]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nhaxuatban = $this->nhaxuatban->find($id);
        return view('nhaxuatbans.edit')->with('nhaxuatban', $nhaxuatban);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->nhaxuatban->updateNhaxuatban($request);

        flash('update success')->success();

        return redirect()->route('nhaxuatbans.index');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->nhaxuatban->find($id)->delete();

        flash('delete success')->error();

        return redirect()->route('nhaxuatbans.index');
        //
    }
}
