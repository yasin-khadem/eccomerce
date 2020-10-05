<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResourceCollection;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductTaggedController extends Controller
{
    public function index(Category $category)
    {
        return new ProductResourceCollection(
            Product::with('categories')
            ->whereHas('categories', function ($query) use ($category) {
                $query->where('slug', $category->slug);
            })->inRandomOrder()->sortByUrl()->searchByUrl()->paginate(10)
        );
    }
}
