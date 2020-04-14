<?php

namespace App\Models;

use App\Models\ModelMPK;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orderdetail extends Model
{
    protected $table = 'orderdetails';

    public $primaryKey = ['order_id', 'book_id'];
    public $timestamps = false;
	public $incrementing = false;
    use SoftDeletes;

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
