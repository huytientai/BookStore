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
    ];

    protected $perPage = 5;

    public function saveBook($request)
    {
        $data = $request->all();
        Book::create($data);
    }


}
