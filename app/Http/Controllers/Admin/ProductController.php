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
    protected $SortingOptions = [
        'id'=>'id',
        'name'=> 'name',
        'code'=> 'code',
        'price'=> 'price',
        'description'=> 'description',
        'exist'=> 'exist',
        'created_at'=> 'created_at'
    ];
    public function index(Request $request)
    {
        $sortBy = $this->SortingOptions[$request->sortBy] ?? 'id';
        $sortDir = collect(['asc','desc'])->contains($request->sortDir) ? $request->sortDir : 'asc';
        return new ProductResourceCollection(Product::orderBy($sortBy,$sortDir)->paginate(1));
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
