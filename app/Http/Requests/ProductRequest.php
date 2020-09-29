<?php

namespace App\Http\Requests;

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
        if(request()->method === 'post' || request()->method === 'POST'){
            return [
                'name'=>'required|string',
                'description'=>'required|string',
                'code'=> 'required|numeric',
                // 'image'=>'required|string',
                'price'=> 'required|numeric|min:1000',
                'selectedTags.0' => 'required',
            ];
        }else{
            return [
                'name' => 'required|string',
                'description' => 'required|string',
                'code' => 'required|numeric',
                // 'image'=>'required|string',
                'price' => 'required|numeric|min:1000',
                'selectedTags.0' => 'required',
            ]; 
        }
    }
}
