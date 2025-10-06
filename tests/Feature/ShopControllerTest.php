<?php

namespace Tests\Feature;

use Tests\TestCase;
use Modules\Product\App\Models\Product;

class ShopControllerTest extends TestCase
{
    /**
     * Test that shop page fetches products from DB.
     */
    public function test_shop_products_are_fetched()
    {
        // Act: hit the shop page
        $response = $this->get('/shop');

        // Assert: correct view is loaded
        $response->assertViewIs('product::shop.index');

        // Assert: view has variable
        $response->assertViewHas('shopProducts');

        // Assert: at least 1 product exists in db and is passed
        $shopProducts = $response->viewData('shopProducts');
        $this->assertGreaterThan(0, $shopProducts->count());
    }
}
