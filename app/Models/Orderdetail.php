<?php

namespace App\Models;

use App\Models\ModelMPK;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Orderdetail extends ModelMPK
{
    protected $table = 'orderdetails';

    public $primaryKey = ['order_id', 'book_id'];
    public $timestamps = false;
	public $incrementing = false;

    protected $fillable = [
        'order_id',
        'book_id',
        'sell_price',
        'quantity',
    ];
	
	 /*protected function setKeysForSaveQuery(Builder $query)
            {
                return $query->where('order_id', $this->getAttribute('order_id'))
                             ->where('book_id', $this->getAttribute('book_id'));
            }*/

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
