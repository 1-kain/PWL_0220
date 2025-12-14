<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    // Wajib: agar kolom dynamic_attributes dibaca sebagai Array/JSON
    protected $casts = [
        'dynamic_attributes' => 'array',
    ];

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
    
    // Helper methods
    public function totalIn() {
        return $this->transactions->where('type', 'in')->sum('quantity');
    }
    public function totalOut() {
        return $this->transactions->where('type', 'out')->sum('quantity');
    }
}