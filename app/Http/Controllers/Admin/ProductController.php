<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\DB;
use Exception;

class ProductController extends Controller
{
    public function index()
    {
    }

    public function store(ProductRequest $request)
    {

        DB::transaction(function () use ($request){
            try {
                $data = $request->except('selectedTags');
                $product = Product::create($data);
                $product->syncCategories($request->selectedTags);
                return response(['ok'], 200);
            } catch (Exception $exception) {
                DB::rollBack();
                return response(['error'], 500);
            }
        });
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
