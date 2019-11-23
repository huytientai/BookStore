<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class loaisach extends Model
{
    protected $table = 'loaisachs';

    public $primaryKey = 'typesofbook_id';
    public $timestamps = true;

    protected $fillable = [
        'typesofbook_id',
        'nametype',
        'created_at',
        'updated_at'
    ];

    

}
