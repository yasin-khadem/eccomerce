<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name'=>'required|max:255|string',
            'email'=> 'required|max:255|email|unique:users,email,' . request('id'),
            'password'=>'nullable|min:6',
        ];
    }
    public function messages()
    {
        return [
            'password.min'=>'رمز نباید کمتر از 6 کاراکتر باشد',
            'password.email'=>'ایمیل معتبر نیست',
            'email.required'=>'ایمیل الزامی است',
            'email.max'=>'بیش از 255 کاراکتر مجاز نیست',
            'name.max'=>'بیش از 255 کاراکتر مجاز نیست',
            'email.unique'=>'ابن ایمیل قبلا استفاده شده',
            'name.required'=>'نام الزامی است',
        ];
    }
}
