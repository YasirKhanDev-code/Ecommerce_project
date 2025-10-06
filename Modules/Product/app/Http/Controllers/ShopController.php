<?php

namespace Modules\Product\App\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Product\App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $shopProducts = Product::all();
        return view('product::shop.index', compact('shopProducts'));
    }
}
