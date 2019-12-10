<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    protected $table = 'orderdetails';

    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'order_id',
        'book_id',
        'sell_price',
        'quantity',
    ];

    protected $perPage = 10;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }
}
