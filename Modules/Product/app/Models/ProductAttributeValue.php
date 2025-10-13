<?php

namespace Modules\Product\App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeValue extends Model
{
    // Specify the pivot table
    protected $table = 'product_attribute_values';

    // Pivot tables usually don’t have timestamps
    public $timestamps = false;

    // Mass-assignable fields
    protected $fillable = [
        'product_id',
        'attribute_value_id',
    ];

    /**
     * Relation to Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Relation to AttributeValue
     */
    public function attributeValue()
    {
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id');
    }
}
