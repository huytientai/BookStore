<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $table = 'orders';

    public $primaryKey = 'id';
    public $timestamps = true;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'name',
        'phone',
        'address',
        'email',
        'company',
    ];

    protected $perPage = 10;

    public function updateOrder($request)
    {
        $data = $request->all();

        return $this->find($request->id)->update($data);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function orderdetails()
    {
        return $this->hasMany('App\Models\Orderdetail');
    }
}
