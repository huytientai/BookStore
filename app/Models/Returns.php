<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Returns extends Model
{
    protected $table = 'returns';
    public $primaryKey = 'order_id';
    public $timestamps = true;

    protected $fillable = [
        'order_id',
        'status',
        'ship_merchant',
        'ship_code',
        'image',
    ];

    protected $perPage = 5;

    const WAITING = 0;
    const CHECKED = 1;
    const DONE = 2;


    public function saveReturns($request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $clientImageName = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            $clientImageExtension = $request->image->getClientOriginalExtension();
            $data['image'] = $clientImageName . '_' . time() . '.' . $clientImageExtension;
            $request->file('image')->storeAs('public/returns_images', $data['image']);
        } else {
            $data['image'] = null;
        }

        return self::create($data);
    }

    public function updateReturns($request)
    {
        $data = $request->all();

//        if (isset($data['order_id'])) {
//            unset($data['order_id']);
//        }

        if ($request->hasFile('image')) {
            $clientImageName = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            $clientImageExtension = $request->image->getClientOriginalExtension();
            $data['image'] = $clientImageName . '_' . time() . '.' . $clientImageExtension;
            $request->file('image')->storeAs('public/returns_images', $data['image']);
        } else {
//            if (isset($data['image'])) {
//                unset($data['image']);
//            }
            $data['image'] = $this->find($request->order_id)->image;

        }

//        dd($data);
        return self::find($request->order_id)->update($data);
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
