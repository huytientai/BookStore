<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Book extends Model
{
    protected $table = 'books';

    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'desc',
        'image',
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

}
