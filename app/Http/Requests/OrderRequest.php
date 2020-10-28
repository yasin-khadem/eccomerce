<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'mobile_number' => 'required|min:11|max:11',
            'phone_number' => 'required',
            'post_code' => 'required|min:10|max:10',
            'address' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'mobile_number.required' => 'شماره موبایل الزامی است',
            'mobile_number.min' => 'شماره موبایل باید 11 رقم باشد',
            'mobile_number.max' => 'شماره موبایل باید 11 رقم باشد',
            'phone_number.required' => 'شماره تماس الزامی است',
            'address.required' => 'آدرس الزامی است',
            'post_code.required' => 'کد پستی الزامی است',
            'post_code.min' => 'کد پستی باید 10 رقم باشد',
            'post_code.max' => 'کد پستی باید 10 رقم باشد',
        ];
    }
}
