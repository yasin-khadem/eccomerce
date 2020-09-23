<?php

namespace App\Traits;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;

trait MakeProductModel
{

    protected $product;
    public function createOrUpdate(Request $request, Product $product = null)
    {
        return DB::transaction(function () use ($request, $product) {
            try {
                $data = $request->except('selectedTags', 'image');
                $image_name = $this->makePublicImage($request);
                if ($image_name) {
                    $data['image'] = $image_name;
                }
                if ($product === null) {
                    $product = Product::create($data);
                } else {
                    $image_name = $this->makePublicImage($request, $product);
                    if ($image_name) {
                        $data['image'] = $image_name;
                    }
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

    protected function makePublicImage(ProductRequest $request, Product $product = null)
    {
        if ($request->hasFile('image')) {
            if ($product !== null) {
                $this->product->removeFromPublic($product->image_src);
            }

            return $this->product->storePublicImage($request->file('image'));
        }
        return null;
    }
}
