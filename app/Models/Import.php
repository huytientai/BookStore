<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Import extends Model
{
    protected $table = 'imports';
    public $primaryKey = 'id';
    public $timestamps = true;
    use  SoftDeletes;

    protected $fillable = [
        'user_id',
        'book_id',
        'quantity',
        'from',
        'note',
        'warehouseman_id',
        'status',
    ];
    protected $perPage = 10;


    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function warehouseman()
    {
        return $this->belongsTo('App\Models\User','warehouseman_id');
    }

    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }
}
