<?php

namespace Modules\Product\App\Http\Controllers; // ✅ add this

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Modules\Product\App\Models\Product;
use Modules\Product\App\Models\Category;

use Modules\Product\App\Models\Attribute;
use Modules\Product\App\Models\AttributeValue;
       use Illuminate\Support\Facades\DB;


class ShopController extends Controller
{

public function index(Request $request)
{


    // Start query with relationship
    $query = Product::query()->with('attributeValues');

    // ===== Price Filter =====
    if ($request->filled('prices')) {
        $priceRanges = $request->prices;
        $query->where(function ($q) use ($priceRanges) {
            foreach ($priceRanges as $range) {
                [$min, $max] = explode('-', $range);
                $q->orWhereBetween('price', [(float) $min, (float) $max]);
            }
        });
    }

    // ===== Attribute Filters (Color, Size, etc.) =====
    if ($request->filled('attributes')) {
        $attributes1 = $request->input('attributes');
        
        // exit();
    foreach ($attributes1 as $attributeId => $valueIds) {
      
        $query->whereHas('attributeValues', function ($q) use ($attributeId, $valueIds) {
    $q->where('attribute_values.attribute_id', $attributeId)
      ->whereIn('attribute_values.id', $valueIds);
});
    }
}


    // Get filtered products
    $products = $query->get();

    // Load all attributes for sidebar
    $attributes = Attribute::with('values')->get();

    return view('product::shop.index', compact('products', 'attributes', 'request'));
}




 public function categoryProducts($slug)
    {
        // find category by slug or fail (404)
        $category = Category::where('slug', $slug)->firstOrFail();

        // Fetch products assigned to this category (with pagination)
        $products = Product::where('category_id', $category->id)
                            ->latest()
                            ->paginate(12);

        return view('product::shop.category', compact('category', 'products'));
    }



}
