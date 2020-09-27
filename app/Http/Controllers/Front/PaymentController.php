<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Zarinpal\Laravel\Facade\Zarinpal;

class PaymentController extends Controller
{
    public function buy(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        // dd($product->price);
        $amount = $product->price;
        // dd($product);
        // dd($request->address);
        // dd($request->user());
        // dd($request->all());


        $results = Zarinpal::request(
            url(route('callback')),
            $amount,
            $product->name,
        );
        // dd($results);
        if (isset($results['Authority']) && !empty($results['Authority'])) {
            Zarinpal::redirect();
        }

        // save $results['Authority'] for verifying step
        // redirect user to zarinpal

        // after that verify transaction by that $results['Authority']
        // Zarinpal::verify('OK',1000,$results['Authority']);
    }

    public function callback()
    {
    }
}