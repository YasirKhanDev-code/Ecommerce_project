<?php

namespace Modules\Product\App\Http\Controllers; // ✅ add this

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Modules\Product\App\Models\Product;
use Modules\Product\App\Models\Category;
use Modules\Product\App\Models\Attribute;
use Modules\Product\App\Models\AttributeValue;
use Modules\Product\App\Models\Review;

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


public function show($slug)
{
    // 1️⃣ Fetch product with related models
    $product = Product::with([
        'inventories',                    // inventory for price/qty
        'attributeValues.attribute',      // color, size, etc.
        'reviews.user'                    // load reviews with user
    ])->where('slug', $slug)->firstOrFail();

    // 2️⃣ Group attributes by name (e.g. Color => [...], Size => [...])
    $attributes = $product->attributeValues
        ->groupBy(fn($val) => $val->attribute->name);

    // 3️⃣ Calculate average rating and total reviews
    $avgRating = round($product->reviews->avg('rating'), 1) ?? 0;
    $totalReviews = $product->reviews->count();

    // 4️⃣ Related products (optional)
    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->take(4)
        ->get();

    // 5️⃣ Send data to view
    return view('product::shop.product-detail', compact(
        'product',
        'attributes',
        'relatedProducts',
        'avgRating',
        'totalReviews'
    ));
}


public function storeReview(Request $request, $slug)
{
    // 1️⃣ Validate incoming form data
    $validated = $request->validate([
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:1000',
        'name' => 'nullable|string|max:255',
    ]);

    // 2️⃣ Get the product by slug
    $product = Product::where('slug', $slug)->firstOrFail();

    // 3️⃣ Store the review (no auth yet)
    Review::create([
        'product_id' => $product->id,
        'user_id' => 1, // later we'll add auth()->id()
        'rating' => $validated['rating'],
        'comment' => $validated['comment'],
    ]);

    // 4️⃣ Redirect back with message
    return back()->with('success', 'Thanks for your review!');
}


}
