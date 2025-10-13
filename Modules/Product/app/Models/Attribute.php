<?php

namespace Modules\Product\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model{

     use HasFactory;

     protected $fillable=['name','slug'];

    public function values()
    {
       return $this->hasMany(AttributeValue::class);
    }
}