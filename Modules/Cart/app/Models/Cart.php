<?php

namespace Modules\Cart\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Cart\Database\Factories\CartFactory;
class Cart extends Model
{
    protected $fillable = [
        'user_id', 'session_id', 'subtotal', 'discount', 'tax',
        'shipping_cost', 'grand_total', 'coupon_code', 'status'
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calculateTotals()
    {
        $this->subtotal = $this->items->sum('subtotal');
        $this->grand_total = $this->subtotal - $this->discount + $this->tax + $this->shipping_cost;
        $this->save();
    }
}

