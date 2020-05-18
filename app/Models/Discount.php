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
        'start_time',
        'end_time',
    ];
    protected $perPage = 10;


}
