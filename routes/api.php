<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:api')->get('/me', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'Auth'], function () {
    Route::post('login', 'LoginController@login');
    Route::post('refresh-token', 'LoginController@refreshToken');
    Route::post('register', 'RegisterController@register');
    Route::post('forget-password', 'FrogetPasswordController@sendResetLinkEmail')
        ->name('password.forget');
    Route::post('reset-password', 'ResetPasswordController@reset')
        ->name('password.reset');
});
Route::group([
    'middleware' => ['auth:api', 'admin'],
    'namespace' => 'Admin',
    'prefix' => 'admin'
],   function () {
    Route::apiResource('users', 'UserController');
    Route::apiResource('categories', 'CategoryController');
    Route::apiResource('product', 'ProductController');
    Route::apiResource('order', 'OrderController');
    Route::apiResource('comment', 'CommentController')->only('index', 'update', 'destroy');
    Route::get('payment', 'PaymentController@index');
    Route::patch('order/deliver/{order}', 'OrderController@deliver');
    Route::get('categories-search', 'Search\CategoryController@index');
});

Route::apiResource('product', 'Product\ProductController');
Route::get('product/tagged/{category}', 'Product\ProductTaggedController@index');
Route::apiResource('order', 'Order\OrderController')->middleware(['auth:api']);
Route::get('purchased', 'Purchased\PurchasedController@getPurchased')->middleware(['auth:api']);
Route::patch('profile/{user}', 'Front\ProfileController@update')->middleware(['auth:api']);
Route::post('comment', 'Front\CommentController@store')->middleware(['auth:api']);
Route::delete('comment/{comment}', 'Front\CommentController@destroy')->middleware(['auth:api']);
