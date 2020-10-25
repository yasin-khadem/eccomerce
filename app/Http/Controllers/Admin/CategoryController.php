<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  
    
    public function index()
    {
        return new CategoryCollection(Category::orderBy('created_at','desc')->searchFromUrl()->paginate(10));
    }

 
    public function store(Request $request)
    {
        $request->validate(['name'=> 'required|string|max:255|unique:categories']
        ,['name.required'=>'نام الزامی است',
        'name.string'=>'نام باید رشته باشد',
        'name.max'=>'حداکثر تا 255 کاراکتر الزامی است',
        'name.unique'=>'نام ذکر شده تکراری است']);
        Category::create($request->only('name'));

        return response(['ok'],200);
    }
  
    public function show(Category $category)
    {
        return $category;
    }
 
    public function update(Request $request, Category $category)
    {
        $request->validate(['name'=> 'required|string|max:255']);
        $category->update($request->only('name'));
        return response(['ok'],200);
    }

   
    public function destroy(Category $category)
    {
        $category->delete();
        return response(['ok'], 200);

    }
}
