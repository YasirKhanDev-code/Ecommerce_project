<?php

namespace Modules\Product\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AttributeValue extends Model{

     use HasFactory;
    protected $fillable=['attribute_id','value'];
   public function products()
{
    return $this->belongsToMany(
        \Modules\Product\App\Models\Product::class,
        'product_attribute_values',
        'attribute_value_id',
        'product_id'
    );
}

public function attribute()
{
    return $this->belongsTo(\Modules\Product\App\Models\Attribute::class, 'attribute_id');
}
}