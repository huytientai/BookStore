<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    protected $table = 'discount_code';
    public $primaryKey = 'id';
    public $timestamps = true;
    use SoftDeletes;

    protected $fillable = [
        'code',
        'discount',
        'price_condition',
        'num_condition',
        'start_time',
        'end_time',
        'creator_id',
    ];
    protected $perPage = 10;

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'creator_id');
    }
}
