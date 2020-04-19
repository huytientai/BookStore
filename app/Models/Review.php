<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    protected $table = 'reviews';
    public $primaryKey = 'id';
    public $timestamps = true;
    use SoftDeletes;

    protected $fillable = [
        'book_id',
        'name',
        'star',
        'summary',
        'review',
    ];

    public function book(){
        return $this->belongsTo('App\Models\Book');
    }

}
