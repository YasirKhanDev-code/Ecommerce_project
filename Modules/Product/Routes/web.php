<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\App\Http\Controllers\HomeController;
use Modules\Product\App\Http\Controllers\ShopController;
use Modules\Product\App\Http\Controllers\ProductController;


Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/shop',[ShopController::class,'index'])->name('shop');

Route::get('/category/{slug}', [ShopController::class, 'categoryProducts'])->name('shop.category');

   Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
