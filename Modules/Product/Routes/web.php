<?php

use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('product::home.index');
});

Route::get('/check', function () {
    return "✅ Product module route working!";
});

Route::get('/home', function () {
    return view('product::home.index');
});


Route::get('/shop', function () {
    return view('product::shop.index');
});
