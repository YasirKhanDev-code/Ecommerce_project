<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\App\Http\Controllers\HomeController;
use Modules\Product\App\Http\Controllers\ShopController;


Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/shop',[ShopController::class,'index'])->name('shop.index');
