<?php

namespace Modules\Product\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories';

    protected $fillable = [
        'product_id',
        'sku',
        'attribute_value_ids',
        'quantity',
        'price',
        'is_active',
        'location',
    ];

    protected $casts = [
        'attribute_value_ids' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * 🔗 Relationship: Inventory belongs to a Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * 🔗 Get all attribute values related to this inventory (optional)
     */
    public function attributeValues()
    {
        return \Modules\Product\App\Models\AttributeValue::whereIn('id', $this->attribute_value_ids ?? [])->get();
    }

    /**
     * 💡 Accessor Example: display attribute names (like "Red - Large")
     */
    public function getVariantLabelAttribute()
    {
        $values = $this->attributeValues()->pluck('value')->toArray();
        return implode(' - ', $values);
    }
}
