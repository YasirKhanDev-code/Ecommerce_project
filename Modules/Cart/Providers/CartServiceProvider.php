<?php

namespace Modules\Cart\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class CartServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadRoutesFrom(module_path('Cart', '/Routes/web.php'));
        $this->loadViewsFrom(module_path('Cart', '/Resources/views'), 'cart');
        $this->loadMigrationsFrom(module_path('Cart', '/Database/Migrations'));
    }
}
