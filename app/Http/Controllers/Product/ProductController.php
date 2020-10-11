<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResourceCollection;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProductResourceCollection(Product::with('categories')->sortByUrl()->searchByUrl()->paginate(10));
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Product $product)
    {
        return $product->load('categories', 'confirmed_comments.user')->append('related_products');
    }

    public function update(Request $request, Product $product)
    {
        //
    }


    public function destroy(Product $product)
    {
        //
    }
}
