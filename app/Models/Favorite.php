<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $table = 'favorites';

    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'book_id',
        'quantity',
    ];

    protected $perPage = 10;

    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }
}
