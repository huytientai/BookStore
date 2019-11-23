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
            $request->file('image')->storeAs('public/BookImages',$data['image']);
        }
        else{
            $data['image'] = 'no_image.jpg';
        }

        Book::create($data);
    }

    public function updateBook($request)
    {
        $data = $request->all();
        return $this->find($request->id)->update($data);

    }

}
