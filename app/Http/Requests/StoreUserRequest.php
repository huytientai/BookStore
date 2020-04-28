<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'email' => 'required|email|max:100|unique:users,email,' . $this->id ?? '',
            'password' => 'string|max:255|' . (($this->method() == 'POST') ? 'required' : 'nullable'),
            'password_confirmation' => 'required_with:password|same:password',
            'name' => 'required|string|max:255',
            'address' => 'nullable|max:255',
            'phone' => 'digits_between:0,15',
        ];
    }
}
