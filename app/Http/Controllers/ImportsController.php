<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Import;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImportsController extends Controller
{
    protected $import;

    public function __construct(Import $import)
    {
        $this->import = $import;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $imports = $this->import->orderBy('status')->paginate();

        return view('imports.index')->with('imports', $imports);
    }

    public function checkIndex()
    {
        $imports = $this->import->where('status', '=', '0')->get();
        return view('imports.check_index')->with('imports', $imports);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $imports = $this->import->find($request->id);
        dd($imports);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $import = $this->import->find($id);
        return view('imports.show')->with('import', $import);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function accept($id)
    {
        $import = $this->import->find($id);
        $import->status = true;
        $import->accepted_id = Auth::id();
        $import->save();

        $book=Book::find($import->book_id);
        $book->soluong += $import->quantity;
        $book->save();

        flash('Accepted the import');
        return redirect()->route('imports.show', $import->id);
    }

    public function denies($id)
    {
        $this->import->find($id)->delete();

        flash('The import #' . $id . 'was denied')->warning();
        return redirect()->route('imports.index');
    }

    public function revert($id)
    {
        $import = $this->import->find($id);

        $book=Book::find($import->book_id);
        if ($book->soluong < $import->quantity) {
            flash('Not enough quantity to revert')->warning();
            return redirect()->route('imports.show', $import->id);
        }
        $book->soluong -= $import->quantity;
        $book->save();

        $import->status = false;
        $import->save();

        return redirect()->route('imports.show', $import->id);
    }
}
