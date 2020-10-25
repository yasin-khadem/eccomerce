<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResourceCollection;
use App\service\ProductService;
use App\Traits\MakeProductModel;

use Illuminate\Support\Facades\Request as FacadesRequest;

class ProductController extends Controller
{
    use MakeProductModel;
    public function __construct()
    {
        $this->product = new ProductService();
    }
    public function index(Request $request)
    {
        return new ProductResourceCollection(Product::with('categories')->sortByUrl()->searchByUrl()->paginate(10));
    }

    public function store(ProductRequest $request)
    {
        $this->createOrUpdate($request);
        return response(['ok'], 200);
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(ProductRequest $request, Product $product)
    {
        $this->createOrUpdate($request, $product);
        return response(['ok'], 200);
    }
    public function existupdate(Request $request, Product $product)
    {
        if($request->exist === 1){
            $exist = true;
        }else{
            $exist = false;
        }
        $product->update([
            'exist' => !$exist
        ]);
        return response(['ok'], 200);

    }
    public function destroy(Product $product)
    {
        $this->product->removeFromPublic($product->image_src);
        $product->delete();
        return response(['ok'], 200);
    }
}
