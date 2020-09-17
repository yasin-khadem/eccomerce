<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        
    }

    public function store(ProductRequest $request)
    {
        // dd(array_filter(collect($request->selectedTags)->pluck('key')->toArray()));
        $data = $request->except('selectedTags');
        $product = Product::create($data);

        $product->categories()->sync(
            array_filter(collect($request->selectedTags)->pluck('key')->toArray())
        );

        return response(['ok'],200);
    }

    public function show(Product $product)
    {
        
    }

    
    public function update(Request $request, Product $product)
    {
        
    }

    
    public function destroy(Product $product)
    {
        //
    }
}
