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

    public function allLoaisachCount()
    {
        return $this->withCount('books')->orderBy('name')->get();
    }

    public function saveLoaisach($request)
    {
        $data = $request->all();
        Loaisach::create($data);
    }
  
    public function updateLoaisach($request)
    {
        $data = $request->all();
        return $this->find($request->id)->update($data);
    }

    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }
}
