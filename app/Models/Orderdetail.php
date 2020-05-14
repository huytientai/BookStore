<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orderdetail extends Model
{
    protected $table = 'orderdetails';

    public $primaryKey = ['order_id', 'book_id'];
    public $timestamps = false;
    public $incrementing = false;
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'book_id',
        'sell_price',
        'quantity',
    ];

    protected $perPage = 10;

    protected $with = ['book'];

    /** group orderDetails by category,most order,time and limit results
     * @param $category
     * @param $days
     * @param $limit
     * @return $builder
     */
    public function scopeFindHotBook($query, $category, $days, $limit)
    {
        if ($days == null)
            $order_ids = Order::all()->pluck('id');
        else
            $order_ids = Order::where('created_at', '>=', now()->subDays($days)->toDateTimeString())->get()->pluck('id');

        if ($category == null) {
            if ($limit == null)
                $builder = $query->whereIn('order_id', $order_ids)->groupBy('book_id')->orderByRaw('sum(quantity) desc');
            else
                $builder = $query->whereIn('order_id', $order_ids)->groupBy('book_id')->orderByRaw('sum(quantity) desc')->limit($limit);
        } else {
            $book_ids = Book::where('loaisach_id', '=', $category)->get()->pluck('id');

            if ($limit == null)
                $builder = $query->whereIn('order_id', $order_ids)->whereIn('book_id', $book_ids)->groupBy('book_id')->orderByRaw('sum(quantity) desc');
            else
                $builder = $query->whereIn('order_id', $order_ids)->whereIn('book_id', $book_ids)->groupBy('book_id')->orderByRaw('sum(quantity) desc')->limit($limit);
        }
        return $builder;
    }

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

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function book()
    {
        return $this->belongsTo('App\Models\Book');
    }
}
