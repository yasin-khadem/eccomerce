<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

use function Symfony\Component\VarDumper\Dumper\esc;

class ProductRequest extends FormRequest
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
        if (request()->method === 'post' || request()->method === 'POST') {
            return [
                'name' => 'required|string',
                'description' => 'required|string',
                'code' => 'required|string|unique:products',
                // 'image'=>'required|string',
                'price' => 'required|numeric|min:1000',
                'selectedTags.0' => 'required',
            ];
        } else {
            return [
                'name' => 'required|string',
                'description' => 'required|string',
                'code' => 'required|string|unique:products,code, ' . $this->product->id,
                // 'image'=>'required|string',
                'price' => 'required|numeric|min:1000',
                'selectedTags.0' => 'required',
            ];
        }
    }
    public function messages()
    {
        return [
            'selectedTags.0.required'=>'بخش تگ الزامی است',
            'price.required'=> 'قیمت الزامی است',
            'price.numeric'=> 'قیمت باید عدد باشد',
            'price.min'=> 'قیمت نباید کمتر از هزار تومان باشد',
            'name.required' => 'نام الزامی است',
            'name.string' => 'نام باید رشته باشد',
            'code.required' => 'کد محصول الزامی است',
            'code.numeric' => 'کد محصول باید عدد باشد',
            'code.unique' => 'کد محصول قبلا استفاده شده',
            'description.required' => 'توضیحات الزامی است',
            'description.string' => 'توضیحات باید رشته باشد',
        ];
    }
}
