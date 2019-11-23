<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tacgia extends Model
{
    //
	protected $table = 'tacgias';
	
	public $timestamps = true;
	
	protected $fillable = [
		'id',
		'name',
		'email',
		'sdt',
		'diachi'
	];
}
