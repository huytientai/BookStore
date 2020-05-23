<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Import;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
        if (Gate::any(['admin', 'staff', 'warehouseman'], Auth::user())) {
            $imports = $this->import->orderBy('status')->paginate();

            return view('imports.index')->with('imports', $imports);
        }

        flash('You are not authorized');
        return redirect()->route('home');
    }

    public function neededList()
    {
        if (Gate::any(['admin', 'staff', 'warehouse'], Auth::user())) {
            $needed1 = Book::where('soluong', '<', 50)->orderBy('soluong')->orderBy('virtual_nums')->get();

            $id = $needed1->pluck('id')->toArray();
            $needed2 = Book::where('virtual_nums', '<', 20)->whereNotIn('id', $id)->orderBy('virtual_nums')->get();
            return view('imports.neededList')->with(['needed1' => $needed1, 'needed2' => $needed2]);
        }

        flash('You are not authorized');
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $imports = $this->import->find($request->id);
//        dd($imports);
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
//        if (Gate::any(['admin', 'staff', 'warehouseman'], Auth::user())) {
//            $import = $this->import->find($id);
//
//            if ($import == null) {
//                flash('This Import is not existed');
//                return redirect()->route('imports.index');
//            }
//
//            if (Gate::allows('warehouseman', Auth::user())) {
//                if ($import->user_id != Auth::id()) {
//                    flash('This Import is not your')->error();
//                    return back();
//                }
//            }
//
//            $import->delete();
//
//            flash('The import #' . $id . 'was denied')->warning();
//            return redirect()->route('imports.index');
//        }
//
//        flash('You are not authorized')->error();
//        return redirect()->route('home');
    }

    public function accept($id)
    {
        if (Gate::any(['admin', 'staff'], Auth::user())) {
            $import = $this->import->find($id);
            if ($import->status == true) {
                flash('This import is accepted by ' . $import->accepted->name);
                return redirect()->back();
            }
            $import->status = true;
            $import->accepted_id = Auth::id();
            $import->save();

            $book = Book::find($import->book_id);
            $book->soluong += $import->quantity;
            $book->save();

            flash('Accepted the import');
            return redirect()->route('imports.show', $import->id);
        }

        flash('You are not authorized')->error();
        return redirect()->route('home');
    }

    public function denies($id)
    {
        if (Gate::any(['admin', 'staff'], Auth::user())) {
            $import = $this->import->find($id);

            if ($import == null) {
                flash('This Import is not existed');
                return redirect()->route('imports.index');
            }
            $import->delete();

            flash('The import #' . $id . 'was denied')->warning();
            return redirect()->route('imports.index');
        }

        flash('You are not authorized')->error();
        return redirect()->route('home');
    }

    public function revert($id)
    {
        if (Gate::any(['admin', 'staff'], Auth::user())) {
            $import = $this->import->find($id);
            if ($import == null) {
                flash('This import is not existed');
                return redirect()->route('imports.show');
            }

            if ($import->status == false) {
                flash('This import has not been accepted yet');
                return redirect()->route('imports.show');
            }

            $book = Book::find($import->book_id);
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

        flash('You are not authorized')->error();
        return route('home');
    }
}
