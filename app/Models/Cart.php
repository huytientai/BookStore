<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    protected $table = 'carts';

    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'book_id',
        'quantity',
    ];

    protected $perPage = 10;

    public function quickAddToCart($book_id)
    {

        if (!Book::find($book_id)) {
            return 0;
        }
        $cart = $this->where('user_id', Auth::id())->where('book_id', $book_id)->first();
        if (isset($cart) != null) {
            return 2;
        }

        $data['user_id'] = Auth::id();
        $data['book_id'] = $book_id;
        $data['quantity'] = 1;

        Cart::create($data);
        return 1;
    }

    public function saveCart($request)
    {
        $cart = $this->where('user_id', Auth::id())->where('book_id', $request->book_id)->first();
        if ($cart != null) {
            return 0;
        }
        $data = $request->all();
        $data['user_id'] = Auth::id();

        Cart::create($data);
        return 1;
    }

    public function removeCartOfUser()
    {
        $this->where('user_id',Auth::id())->delete();
    }

    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }
}
