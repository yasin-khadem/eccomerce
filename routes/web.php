<?php

use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return view('home');
});
// Route::get('mytest', function () {
//     dd('test passed');
// })->middleware(['auth:api','admin']);

