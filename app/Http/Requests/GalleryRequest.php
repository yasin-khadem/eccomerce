<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
            'product_code'=> 'required|string',
            'image'=> 'required|mimes:jpeg,jpg,png'
        ];
    }
    public function messages()
    {
        return [
            'product_code.required' => 'کد محصول الزامیست',
            'product_code.numeric' => 'کد محصول باید عدد باشد'
        ];  
    }
}
