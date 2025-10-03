<?php
namespace Modules\Product\Providers;

use Illuminate\Support\ServiceProvider;

class ProductServiceProvider extends ServiceProvider
{
public function boot()
{
    $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'product');
    $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');

     $this->publishes([
        __DIR__ . '/../Resources/assets' => public_path('modules/product'),
    ], 'product-assets');
}


}
