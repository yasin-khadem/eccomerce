<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductGuestController extends Controller
{
    public function show(Product $product)
    {
        return $product->load('categories')->append('related_products');
    }
}
