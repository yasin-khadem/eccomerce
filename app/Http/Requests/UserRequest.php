<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if (request()->method === 'POST' || request()->method === 'post') {
            return [
                'name' => 'required|max:255|string',
                'email' => 'required|max:255|email|unique:users,email',
                'password' => 'required',
                'is_admin' => 'bool',
            ];
        } else {
            return [
                'name' => 'required|max:255|string',
                'email' => 'required|max:255|email|unique:users,email,' . request('id'),
                'password' => 'nullable',
                'is_admin' => 'bool',
            ];
        }
    }
}
