<?php

namespace Modules\Product\App\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Product\app\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Trending / Featured products
        $products = Product::all();
        return view('product::home.index',compact('products'));
    }
}
