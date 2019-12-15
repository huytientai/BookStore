<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    public $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'name',
        'loaisach_id',
        'tacgia_id',
        'nhaxuatban_id',
        'desc',
        'image',
        'price',
        'ngayxb',
        'size',
        'loaibia',
        'sotrang',
    ];
    protected $perPage = 5;

    public function saveBook($request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $clientImageName = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            $clientImageExtension = $request->image->getClientOriginalExtension();
            $data['image'] = $clientImageName . '_' . time() . '.' . $clientImageExtension;
            $request->file('image')->storeAs('public/book_images', $data['image']);
        } else {
            $data['image'] = null;
        }
        Book::create($data);
    }

    public function updateBook($request)
    {
        $data = $request->all();
        if ($request->hasFile('image')) {
            $clientImageName = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
            $clientImageExtension = $request->image->getClientOriginalExtension();
            $data['image'] = $clientImageName . '_' . time() . '.' . $clientImageExtension;
            $request->file('image')->storeAs('public/book_images', $data['image']);
        } else {
            $data['image'] = $this->find($request->id)->image;
        }
        return $this->find($request->id)->update($data);
    }

    public function searchBook($data)
    {
        $builder = $this->orderBy('name');
        if (isset($data['name'])) {
            $builder->where('name', 'like', '%' . $data['name'] . '%');
        }

        if (isset($data['min_price'])) {
            $builder->where('price', '>=', $data['min_price']);
        }
        if (isset($data['max_price'])) {
            $builder->where('price', '<=', $data['max_price']);
        }

        if (isset($data['loaisach_id'])) {
            $builder->where('loaisach_id', $data['loaisach_id']);
        }
        if (isset($data['tacgia_id'])) {
            $builder->where('tacgia_id', $data['tacgia_id']);
        }
        if (isset($data['nhaxuatban_id'])) {
            $builder->where('nhaxuatban_id', $data['nhaxuatban_id']);
        }

        return $builder->paginate(12);
    }

    public function findLoaisach($id)
    {
        return $this->orderBy('name')->with('loaisach')->where('loaisach_id', $id);
    }

    public function loaisach()
    {
        return $this->belongsTo('App\Models\Loaisach');
    }

    public function findTacgia($id)
    {
        return $this->orderBy('name')->with('tacgia')->where('tacgia_id', $id);
    }

    public function tacgia()
    {
        return $this->belongsTo('App\Models\tacgia');
    }

    public function findNhaxuatban($id)
    {
        return $this->orderBy('name')->with('nhaxuatban')->where('tacgia_id', $id);
    }

    public function nhaxuatban()
    {
        return $this->belongsTo('App\Models\Nhaxuatban');
    }

}
