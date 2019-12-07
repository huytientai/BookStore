<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'total_price',
    ];

    protected $perPage = 10;

    public function updateOrder($request)
    {
        $data = $request->all();

        return $this->find($request->id)->update($data);
    }

    public function user()
    {
        $this->belongsTo('App\Models\User');
    }
}
