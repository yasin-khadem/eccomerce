<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  
    
    public function index()
    {
        //
    }

 
    public function store(Request $request)
    {
        $request->validate(['name'=>'required|string|max:255']);
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
        //
    }
}
