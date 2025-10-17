<?php

namespace Modules\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Cart\Database\Factories\CartItemFactory;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id', 'product_id', 'variant_data', 'quantity', 'unit_price', 'subtotal'
    ];

    protected $casts = [
        'variant_data' => 'array',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

