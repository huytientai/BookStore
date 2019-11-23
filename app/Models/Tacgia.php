<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tacgia extends Model
{
    //
	protected $table = 'tacgia_table';
	
	public $timestamps = true;
	
	protected $fillable = [
		'tentacgia',
		'email',
		'sdt',
		'diachi'
	];
}
