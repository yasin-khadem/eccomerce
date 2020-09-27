<?php

use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return view('home');
});
Route::post('buy', 'Front\PaymentController@buy')->middleware(['auth:api']);
Route::get('callback', 'Front\PaymentController@callback')->middleware(['auth:api'])->name('callback');
// Route::get('mytest', function () {
//     dd('test passed');
// })->middleware(['auth:api','admin']);

