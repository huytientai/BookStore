<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Returns extends Model
{
    protected $table = 'returns';
    public $primaryKey = 'order_id';
    public $timestamps = true;
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'status',
        'ship_merchant',
        'ship_id',
        'image',
    ];

    protected $perPage = 5;

    const WAITING = 0;
    const CHECKED = 1;
    const DONE = 2;

    public static $status=[
        self::WAITING => 'Waitting',
        self::CHECKED => 'Checked',
        self::DONE => 'Done',
    ];


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

        if ($request->hasFile('image')) {
            $clientImageName = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            $clientImageExtension = $request->image->getClientOriginalExtension();
            $data['image'] = $clientImageName . '_' . time() . '.' . $clientImageExtension;
            $request->file('image')->storeAs('public/returns_images', $data['image']);
        } else {
            if (isset($data['image'])) {
                unset($data['image']);
            }
        }

        return $this->find($request->order_id)->update($data);
    }

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }
}
