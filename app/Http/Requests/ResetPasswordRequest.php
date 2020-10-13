<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'ایمیل الزامی است',
            'email.email'=>'لطفا ایمیل معتبر وارد کنید',
            'password.required'=>'رمز عبور الزامی است',
            'password.confirmed'=>'رمز عبور با تکرار رمز عبور یکسان نیست',
            'password.min'=>'رمز عبور باید حداقل 6 کاراکتری باشد',
        ];
    }

}
