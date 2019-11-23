<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tacgia extends Model
{
    //
	protected $table = 'tacgias';
	
	public $timestamps = true;
	
	protected $fillable = [
		'tacgias_id',
		'tacgias_name',
		'tacgias_email',
		'tacgias_sdt',
		'tacgias_diachi'
	];
}
