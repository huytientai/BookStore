<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Returns extends Model
{
    protected $table = 'returns';
    public $primaryKey = 'id';
    public $timestamps = true;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'status',
        'ship_merchant',
        'ship_code',
        'image',
    ];

    protected $perPage = 5;


    public function order()
    {
        return $this->hasOne('App\Models\Order');
    }
}
