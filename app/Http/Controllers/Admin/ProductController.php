<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResourceCollection;
use App\Traits\MakeProductModel;

use Illuminate\Support\Facades\Request as FacadesRequest;

class ProductController extends Controller
{
    use MakeProductModel;
    public function index(Request $request)
    {
        return new ProductResourceCollection(Product::sortByUrl()->searchByUrl()->paginate(1));
    }

    public function store(ProductRequest $request)
    {
        $this->createOrUpdate($request);
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->createOrUpdate($request,$product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response(['ok'], 200);
    }
   
}
