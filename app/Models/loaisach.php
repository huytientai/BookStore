<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loaisach extends Model
{
    protected $table = 'loaisachs';

    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'tenloaisach',
        'created_at',
        'updated_at'
    ];

    

}
