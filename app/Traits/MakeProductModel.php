<?php 

namespace App\Traits;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;

trait MakeProductModel{
    public function createOrUpdate(Request $request, Product $product = null)
    {
        return DB::transaction(function () use ($request, $product) {
            try {
                $data = $request->except('selectedTags');
                if ($product === null) {
                    $product = Product::create($data);
                } else {
                    $product->update($data);
                }
                $product->syncCategories($request->selectedTags);
                return 200;
            } catch (Exception $exception) {
                DB::rollBack();
                return 500;
            }
        });
    }
}