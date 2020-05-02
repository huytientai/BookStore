<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'password' => 'string|max:255|nullable',
            'password_confirmation' => 'required_with:password|same:password',
            'name' => 'required|string|max:255',
            'address' => 'nullable|max:255',
            'phone' => 'digits_between:0,15',
        ];
    }
}
