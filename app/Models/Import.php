<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $table = 'imports';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'book_id',
        'quantity',
        'from',
        'note',
        'accepted_id',
        'status',
    ];
    protected $perPage = 10;

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function accepted()
    {
        return $this->belongsTo('App\Models\User','accepted_id');
    }

    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }
}
