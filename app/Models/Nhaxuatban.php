<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Nhaxuatban extends Model
{
    //
	protected $table = 'NhaxuatbanTable';
	
	public $timestamps = true;
	
	protected $fillable = [
		'id',
		'nxb_ten',
		'nxb_diachi',
		'nxb_sdt',
		'nxb_email',
                'nxb_website'
	];
}
