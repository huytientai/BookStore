<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nhaxuatban extends Model
{
    protected $table = 'nhaxuatbans';

    public $timestamps = true;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'address',
        'phone',
        'image',

    ];

    protected $perPage = 5;

    public function updateNhaxuatban($request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $clientImageName = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            $clientImageExtension = $request->image->getClientOriginalExtension();
            $data['image'] = $clientImageName . '_' . time() . '.' . $clientImageExtension;

            $request->file('image')->storeAs('public/nhaxuatban_images', $data['image']);
        } else {
            $data['image'] = $this->find($request->id)->image;
        }

        return $this->find($request->id)->update($data);
    }

    public function saveNhaxuatban($request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $clientImageName = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            $clientImageExtension = $request->image->getClientOriginalExtension();
            $data['image'] = $clientImageName . '_' . time() . '.' . $clientImageExtension;

            $request->file('image')->storeAs('public/nhaxuatban_images', $data['image']);
        } else {
            $data['image'] = null;
        }

        Nhaxuatban::create($data);
    }

    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }
}
