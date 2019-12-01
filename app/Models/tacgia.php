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
		'address'
	];
	protected $perPage = 5;

    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }
}
