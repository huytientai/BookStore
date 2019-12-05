<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tacgia extends Model
{
    //
	protected $table = 'tacgias';
	
	public $timestamps = true;
	
	protected $fillable = [
		'id',
		'name',
		'email',
		'phone',
		'address',
		'desc'
	];
	protected $perPage = 5;

    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }
	
	public function updateTacgia($request)
    {
        $data = $request->all();

        

        return $this->find($request->id)->update($data);
    }
	public function saveTacgia($request)
    {
        $data = $request->all();

        

        Tacgia::create($data);
    }
}
