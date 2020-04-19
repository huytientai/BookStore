<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'book_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'star' => 'required|integer|min:1|max:5',
            'summary' => 'required|string|max:255',
            'review' => 'required|string|max:255',
        ];
    }
}
