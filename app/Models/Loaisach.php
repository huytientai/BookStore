<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loaisach extends Model
{
    protected $table = 'loaisachs';

    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
    ];

    

}
