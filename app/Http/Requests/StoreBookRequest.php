<?php

namespace App\Http\Requests;

use App\Models\Loaisach;
use App\Models\Nhaxuatban;
use App\Models\Tacgia;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:100|unique:books,name,' . $this->id ?? '',
            'desc' => 'nullable|max:3000',
            'price' => 'gt:0',
            'loaisach_id' => Rule::in(Loaisach::pluck('id')->toArray()),
            'tacgia_id' => Rule::in(Tacgia::pluck('id')->toArray()),
            'nhaxuatban_id' => Rule::in(Nhaxuatban::pluck('id')->toArray()),
            'sotrang' => 'nullable||integer|min:0',
            'soluong' => 'nullable||integer|min:0',
        ];
    }
}
