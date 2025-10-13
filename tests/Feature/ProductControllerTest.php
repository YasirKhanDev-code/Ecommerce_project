<?php

namespace Tests\Feature;

use Tests\TestCase;
use Modules\Product\App\Models\Product;

class ProductControllerTest extends TestCase
{
    /**
     * Test: Shop page returns products from database
     */
    public function test_shop_page_returns_products()
    {
        $response = $this->get(route('shop'));
        $response->assertStatus(200);

        $products = Product::all();
        foreach ($products as $product) {
            $response->assertSeeText($product->name);
        }
    }

    /**
     * Test: Shop page filters products by price
     */
    public function test_shop_page_filters_products_by_price()
    {
        $priceRange = '0-100';
        $response = $this->get(route('shop', ['price' => $priceRange]));
        $response->assertStatus(200);

        [$min, $max] = explode('-', $priceRange);

        // Check products inside range are visible
        $productsInRange = Product::whereBetween('price', [(int)$min, (int)$max])->get();
        foreach ($productsInRange as $product) {
            $response->assertSeeText($product->name);
        }

        // Products outside range should not appear
        $productsOutRange = Product::whereNotBetween('price', [(int)$min, (int)$max])->get();
        foreach ($productsOutRange as $product) {
            $response->assertDontSeeText($product->name);
        }
    }

    /**
     * Test: Shop page filters products by color
     */
    public function test_shop_page_filters_products_by_color()
    {
        $color = 'Red';
        $response = $this->get(route('shop', ['colors' => [$color]]));
        $response->assertStatus(200);

        $productsWithColor = Product::whereHas('attributeValues', function($q) use ($color) {
            $q->where('value', $color);
        })->get();

        foreach ($productsWithColor as $product) {
            $response->assertSeeText($product->name);
        }

        // Optionally, products without color
        $productsWithoutColor = Product::whereDoesntHave('attributeValues', function($q) use ($color) {
            $q->where('value', $color);
        })->get();

        foreach ($productsWithoutColor as $product) {
            $response->assertDontSeeText($product->name);
        }
    }

    /**
     * Test: Shop page filters products by size
     */
    public function test_shop_page_filters_products_by_size()
    {
        $size = 'M';
        $response = $this->get(route('shop.index', ['sizes' => [$size]]));
        $response->assertStatus(200);

        $productsWithSize = Product::whereHas('attributeValues', function($q) use ($size) {
            $q->where('value', $size);
        })->get();

        foreach ($productsWithSize as $product) {
            $response->assertSeeText($product->name);
        }

        $productsWithoutSize = Product::whereDoesntHave('attributeValues', function($q) use ($size) {
            $q->where('value', $size);
        })->get();

        foreach ($productsWithoutSize as $product) {
            $response->assertDontSeeText($product->name);
        }
    }
}
