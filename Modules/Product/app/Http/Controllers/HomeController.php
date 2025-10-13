<?php

namespace Modules\Product\App\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Product\app\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Trending / Featured products
        $featuredProducts = Product::where('is_featured',true)->get();
        $latestProducts=Product::latest()->take(5)->get();
        return view('product::home.index',compact('featuredProducts','latestProducts'));
    }
}
