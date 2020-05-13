<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableOfContents extends Model
{
    protected $table = 'table_of_contents';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'book_id',
        'picture',
    ];
    protected $perPage = 5;

    public function saveTableOfContents($request)
    {
        $data['book_id'] = $request->id;

        $contents = $request->contents;
        if (isset($contents)) {
            foreach ($contents as $key => $content) {
                $clientImageName = pathinfo($content->getClientOriginalName(), PATHINFO_FILENAME);
                $clientImageExtension = $content->getClientOriginalExtension();
                $data['picture'] = $key . $clientImageName . '_' . time() . '.' . $clientImageExtension;
                $request->file('contents.' . $key)->storeAs('public/table_of_contents', $data['picture']);
                $this->create($data);
            }
        }
    }

    public function updateTableOfContents($request)
    {
        $data['book_id'] = $request->id;

        $contents = $request->contents;
        if (isset($contents)) {
            $this->where('book_id',$data['book_id'])->delete();
            foreach ($contents as $key => $content) {
                $clientImageName = pathinfo($content->getClientOriginalName(), PATHINFO_FILENAME);
                $clientImageExtension = $content->getClientOriginalExtension();
                $data['picture'] = $key . $clientImageName . '_' . time() . '.' . $clientImageExtension;
                $request->file('contents.' . $key)->storeAs('public/table_of_contents', $data['picture']);
                $this->create($data);
            }
        }
    }
}
