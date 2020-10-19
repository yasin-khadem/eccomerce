<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|max:255|string',
            'email' => 'required|max:255|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'نام الزامیست',
            'name.max' => 'بیش از 255 کاراکتر مجاز نیست',
            'name.string' => 'نام باید رشته باشد',
            'email.required' => 'نام الزامیست',
            'email.max' => 'بیش از 255 کاراکتر مجاز نیست',
            'email.email' => 'ایمیل باید معتبر باشد',
            'email.unique' => 'این ایمیل قبلا استفاده شده',
            'password.required' => 'رمز عبور الزامیست',
            'password.confirmed' => 'رمز عبور و تکرار آن یکسان نیست',
            'password.min' => 'رمز عبور باید حداقل 6 کاراکتر باشد'
        ];
    }
}
