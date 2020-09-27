<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function buy(Request $request){
        $product = Product::findOrFail($request->product_id);
        // dd($product);
        dd($request->address);
        // dd($request->user());
        // dd($request->all());

    }
}
