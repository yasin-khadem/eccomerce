<?php

use Illuminate\Support\Facades\Route;

Route::get('/auth/login', function(){
    return view('home');
})->name('login');

Route::fallback(function () {
    return view('home');
});
Route::post('buy', 'Front\PaymentController@buy')->middleware(['auth:api']);
Route::get('callback', 'Front\PaymentController@callback')->name('callback');
// Route::get('mytest', function () {
//     dd('test passed');
// })->middleware(['auth:api','admin']);

