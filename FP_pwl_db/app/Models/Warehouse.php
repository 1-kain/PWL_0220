<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $guarded = [];

    public function products() {
        return $this->hasMany(Product::class);
    }
    
    public function categories() {
        return $this->hasMany(Category::class);
    }
    
    public function customAttributes() {
        return $this->hasMany(CustomAttribute::class);
    }
}