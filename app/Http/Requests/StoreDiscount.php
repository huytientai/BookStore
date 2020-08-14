<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscount extends FormRequest
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
            'code' => 'required|string|max:100|unique:discount_code,code,' . $this->id ?? '',
            'discount' => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'start_time' => 'required',
            'end_time' => 'nullable|after:start_time',
            'price_condition' => 'nullable',
            'num_condition' => 'nullable',
        ];
    }
}
