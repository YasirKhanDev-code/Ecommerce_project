<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Category extends Model{
use HasFactory;

protected $fillable=[
'name', 'slug', 'description', 'image', 'parent_id'
];

public function products(){
   return $this->hasMany(Product::class);
}

}