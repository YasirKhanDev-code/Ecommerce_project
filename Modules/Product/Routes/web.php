<?php

use Illuminate\Support\Facades\Route;


Route::get('/check', function () {
    return "✅ Product module route working!";
});


Route::get('/shop', function () {
    return view('product::shop.index');
});
use Modules\Product\App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
