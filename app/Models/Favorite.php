<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Favorite extends Model
{
    protected $table = 'favorites';

    public $primaryKey = ['user_id', 'book_id'];

    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'book_id',
    ];

    protected $perPage = 10;

    /**
     * Set the keys for a save update query.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getKeyName();
        if (!is_array($keys)) {
            return parent::setKeysForSaveQuery($query);
        }
        foreach ($keys as $keyName) {
            $query->where($keyName, '=', $this->getKeyForSaveQuery($keyName));
        }

        return $query;
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if (is_null($keyName)) {
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }


    public function saveFavorite($request)
    {
        $cart = $this->where('user_id', Auth::id())->where('book_id', $request->book_id)->first();
        if ($cart != null) {
            return 0;
        }
        $data = $request->all();
        $data['user_id'] = Auth::id();

        $this->create($data);
        return 1;
    }

    public function removeAllFavoritesOfUser()
    {
        $this->where('user_id', Auth::id())->delete();
    }

    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }
}
