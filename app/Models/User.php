<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $perPage = 20;

    protected $fillable = [
        'username',
        'password',
        'name',
        'address',
        'phone',
    ];
}
