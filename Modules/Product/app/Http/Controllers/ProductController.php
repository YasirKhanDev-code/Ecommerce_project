<?php

namespace Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('product::index');
    }

   use Modules\Product\App\Models\Product;
use Modules\Product\App\Models\AttributeValue;
use Illuminate\Http\Request;

public function shop(Request $request)
{
    $query = Product::query();

    // Price filter
    if ($request->filled('price')) {
        [$min, $max] = explode('-', $request->price);
        $query->whereBetween('price', [(int)$min, (int)$max]);
    }

    // Color filter
    if ($request->filled('colors')) {
        $query->whereHas('attributeValues', function($q) use ($request) {
            $q->whereIn('value', $request->colors);
        });
    }

    // Size filter
    if ($request->filled('sizes')) {
        $query->whereHas('attributeValues', function($q) use ($request) {
            $q->whereIn('value', $request->sizes);
        });
    }

    $products = $query->paginate(12);

    // Price ranges dynamically
    $priceRanges = [
        ['range' => '0-100', 'count' => Product::whereBetween('price', [0,100])->count()],
        ['range' => '100-200', 'count' => Product::whereBetween('price', [100,200])->count()],
        ['range' => '200-300', 'count' => Product::whereBetween('price', [200,300])->count()],
        ['range' => '300-400', 'count' => Product::whereBetween('price', [300,400])->count()],
        ['range' => '400-500', 'count' => Product::whereBetween('price', [400,500])->count()],
    ];

    // Colors & Sizes from attribute_values table
    $colors = AttributeValue::whereHas('attribute', fn($q) => $q->where('name', 'Color'))->get();
    $sizes  = AttributeValue::whereHas('attribute', fn($q) => $q->where('name', 'Size'))->get();

    return view('product::shop.index', compact('products','priceRanges','colors','sizes'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('product::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
