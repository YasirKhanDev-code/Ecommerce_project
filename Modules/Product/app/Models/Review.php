<?php

namespace Modules\Product\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    // Mass assignable fields
    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'comment',
    ];

    /**
     * Review belongs to a Product
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(\Modules\Product\App\Models\Product::class);
    }

    /**
     * Review belongs to a User
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
