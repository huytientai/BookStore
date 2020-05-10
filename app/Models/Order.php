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
        'finished_id',
    ];

    const WAITING = 0;
    const CHECKED = 1;
    const SHIPPING = 2;
    const DONE = 3;

    public static $status = [
        self::WAITING => 'Waiting',
        self::CHECKED => 'Checked',
        self::SHIPPING => 'Shipping',
        self::DONE => 'Done',
    ];

    protected $perPage = 10;

    /**
     *  define scope
     */
    public function scopeFindOrderId($query, $order_id)
    {
        return $query->where('order_id', $order_id);
    }

    public function scopeFindName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

    public function scopeFindUserId($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    public function scopeFindPhone($query, $phone)
    {
        return $query->where('phone', 'like', '%' . $phone . '%');
    }

    public function scopeFindEmail($query, $email)
    {
        return $query->where('email', 'like', '%' . $email . '%');
    }

    public function scopeFindAddress($query, $address)
    {
        return $query->where('address', 'like', '%' . $address . '%');
    }

    public function scopeFindCompany($query, $company)
    {
        return $query->where('company', 'like', '%' . $company . '%');
    }

    public function scopeFindDate($query, $date)
    {
        $lastDate = date_create($date);
        date_add($lastDate, date_interval_create_from_date_string("1 days"));

        return $query->where('created_at', '>=', $date)->where('created_at', '<', $lastDate);
    }

    public function scopeFindStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function orderdetails()
    {
        return $this->hasMany('App\Models\Orderdetail');
    }

    public function finished()
    {
        return $this->belongsTo('App\Models\User', 'finished_id');
    }
}
