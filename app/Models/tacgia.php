<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tacgia extends Model
{
	protected $table = 'tacgias';
	
	public $timestamps = true;
    use SoftDeletes;

    protected $fillable = [
		'id',
		'name',
        'born',
        'nationality',
		'email',
		'phone',
		'address',
		'desc',
		'image'
	];
	protected $perPage = 5;
	
	public function updateTacgia($request)
    {
        $data = $request->all();

         if ($request->hasFile('image')) {
            $clientImageName = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            $clientImageExtension = $request->image->getClientOriginalExtension();
            $data['image'] = $clientImageName . '_' . time() . '.' . $clientImageExtension;

            $request->file('image')->storeAs('public/tacgia_images', $data['image']);
        } else {
            $data['image'] = $this->find($request->id)->image;
        }

        return $this->find($request->id)->update($data);
    }
	public function saveTacgia($request)
    {
        $data = $request->all();
		if ($request->hasFile('image')) {
            $clientImageName = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            $clientImageExtension = $request->image->getClientOriginalExtension();
            $data['image'] = $clientImageName . '_' . time() . '.' . $clientImageExtension;

            $request->file('image')->storeAs('public/tacgia_images', $data['image']);
        } else {
            $data['image'] = null;
        }

        Tacgia::create($data);
    }

    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }
}
