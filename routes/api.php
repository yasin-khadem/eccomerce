<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/me', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'Auth'], function () {
    Route::post('login', 'LoginController@login');
    Route::post('register', 'RegisterController@register');
});
Route::group(['middleware' => ['auth:api','admin'] , 
                'namespace'=> 'Admin', 
                'prefix' => 'admin'],   function () {
    Route::apiResource('users','UserController');
    Route::apiResource('categories','CategoryController');
    Route::apiResource('product','ProductController');
    Route::get('categories-search', 'Search\CategoryController@index');
});

Route::apiResource('product','Product\ProductController');