<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResourceCollection;
use Illuminate\Support\Facades\DB;
use Exception;

class ProductController extends Controller
{
    public function index()
    {
        return new ProductResourceCollection(Product::paginate(2));
    }

    public function store(ProductRequest $request)
    {

        DB::transaction(function () use ($request){
            try {
                $data = $request->except('selectedTags');
                $product = Product::create($data);
                $product->syncCategories($request->selectedTags);
                return 200;
            } catch (Exception $exception) {
                DB::rollBack();
                return 500;
            }
        });
        return response(['ok'], 200);
    }

    public function show(Product $product)
    {
    }

    public function update(Request $request, Product $product)
    {
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response(['ok'],200);
    }
}
