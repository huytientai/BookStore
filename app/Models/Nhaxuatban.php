<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Nhaxuatban extends Model
{
    //
	protected $table = 'nhaxuatbans';
	
	public $timestamps = true;
	
	protected $fillable = [
		'id',
		'name',
		'address',
		'phone'
		
	];

protected $perPage = 5;

    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }
public function updateNhaxuatban($request)
    {
        $data = $request->all();
        
        return $this->find($request->id)->update($data);
    }
	public function saveNhaxuatban($request)
    {
        $data = $request->all();
        
        Nhaxuatban::create($data);
    }
}
