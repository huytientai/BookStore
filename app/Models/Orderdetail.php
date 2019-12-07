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

    public function saveOrderdetail($request)
    {
        $data = $request->all();


        Orderdetail::create($data);
    }

    public function updateOrderdetail($request)
    {
        $data = $request->all();

        return $this->find($request->id)->update($data);
    }

    public function user()
    {
        $this->belongsTo('App\Models\User');
    }

    public function books()
    {
        $this->hasMany('App\Models\Book');
    }
}
