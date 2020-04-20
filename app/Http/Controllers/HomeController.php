<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\tacgia;

class HomeController extends Controller
{
    protected $book;
    protected $orderdetail;
    protected $tacgia;
    protected $order;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Book $book, Orderdetail $orderdetail, tacgia $tacgia, Order $order)
    {
        $this->book = $book;
        $this->orderdetail = $orderdetail;
        $this->tacgia = $tacgia;
        $this->order = $order;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        dd($this->orderdetail->whereIn('book_id', $this->book->where('loaisach_id', '=', 11)->get()->pluck('id'))->get()->pluck('book_id'));

        //new book
        $new_books = $this->getNewBooks(30, 10);

        //hot books
        $b0 = $this->getHotBooks(null, 30, 10);

        $b1 = $this->getHotBooks(11, 30, 10);
        $b2 = $this->getHotBooks(12, 30, 10);
        $b3 = $this->getHotBooks(13, 30, 10);
        $b4 = $this->getHotBooks(14, 30, 10);

        $tacgias = $this->book->groupBy('tacgia_id')->orderByRaw('count(*) desc')->limit(3)->get()->pluck('tacgia');

        $best_books = $this->getBestBooks();

        return view('home')->with(['b0' => $b0, 'b1' => $b1, 'b2' => $b2, 'b3' => $b3, 'b4' => $b4, 'tacgias' => $tacgias, 'best_books' => $best_books, 'new_books' => $new_books]);
    }

    protected function getNewBooks($days, $limit)
    {
        $books = $this->book->where('created_at', '>=', now()->subDays($days)->toDateTimeString())->get();

        $result = $this->orderdetail->whereIn('book_id', $books->pluck('id'))->findHotBook(null, $days, $limit)->get()->pluck('book');
        $result = $this->convertArray($result);

        if (count($result) < $limit) {
            $x = $limit - count($result);
            foreach ($books as $book) {
                if (!in_array($book, $result, true)) {
                    array_push($result, $book);
                    if ($x-- == 0) {
                        break;
                    }
                }
            }
        }
        return $result;
    }

    protected function getHotBooks($category, $days, $limit)
    {
        $orderdetailGroups = $this->orderdetail->findHotBook($category, $days, $limit)->get();
        $id = $this->convertArray($orderdetailGroups->pluck('book_id'));

        if (count($id) < $limit) {
            $x = $limit - count($id);
            $array = $this->orderdetail->whereNotIn('book_id', $id)->findHotBook($category, null, $x)->get()->pluck('book_id');

            foreach ($array as $value) {
                array_push($id, $value);
            }
        }

        if (count($id) < $limit) {
            $x = $limit - count($id);
            if ($category == null) {
                $array = $this->book->whereNotIn('id', $id)->limit($x)->get()->pluck('book_id');
            } else
                $array = $this->book->where('loaisach_id', '=', $category)->whereNotIn('id', $id)->limit($x)->get()->pluck('id');

            foreach ($array as $value) {
                array_push($id, $value);
            }
        }

        return $this->book->whereIn('id', $id)->get();
    }

    protected function convertArray($pluck)
    {
        $array = [];
        for ($i = 0; $i < count($pluck); $i++) {
            $array[$i] = $pluck[$i];
        }
        return $array;
    }

    /** get best seller . if orderDetail<0 then get book follow id
     * @return array
     */
    protected function getBestBooks()
    {
        $limit = 7;
        $pluck = $this->orderdetail->groupBy('book_id')->orderByRaw('sum(quantity) desc')->limit($limit)->get()->pluck('book');
        $result = $this->convertArray($pluck);

        if (count($result) < $limit) {
            if (count($result))
                $books = $this->book->whereNotIn('id', $result->pluck('id'))->limit($limit - count($result))->get();
            else
                $books = $this->book->limit($limit - count($result))->get();

            foreach ($books as $book) {
                array_push($result, $book);
            }
        }
        return $result;
    }
}
