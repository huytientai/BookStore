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

    protected $perPage = 5;

    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }
    public function findLoaisach($id)
    {
        return $this->orderBy('name')->with('loaisach')->where('loaisach_id',$id);
    }

    public function loaisach()
    {
        return $this->belongsTo('App\Models\Loaisach');
    }
}
