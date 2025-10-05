<?php

namespace Tests\Feature;

use Tests\TestCase;
use Modules\Product\App\Models\Product;
use Modules\Product\App\Models\Category; // category model import karo

class HomeControllerTest extends TestCase
{
    /**
     * Test that trending (featured) products are fetched correctly.
     */
 public function test_products_are_fetched_from_db()
{
    $response = $this->get('/home');

    $response->assertStatus(200);

    // Check ke "Colorful Stylish Shirt" at least ek baar dikh raha hai
    $response->assertSee('Colorful Stylish Shirt');

    // DB me exactly 8 products hone chahiye
    $this->assertCount(8, \Modules\Product\App\Models\Product::all());
}

}
