<?php

namespace Modules\Product\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
  

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'old_price',
        'stock', 'sku', 'category_id', 'image', 'status','is_featured'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFeatured($query)
{
    return $query->where('is_featured', true);
}

public function attributeValues()
{
    return $this->belongsToMany(
        \Modules\Product\App\Models\AttributeValue::class,
        'product_attribute_values', // pivot table
        'product_id',
        'attribute_value_id'
    )->with('attribute'); // important!
}


public function inventories()
{
    return $this->hasMany(Inventory::class);
}


}
