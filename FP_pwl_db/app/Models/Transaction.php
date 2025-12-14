<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    // Logic Trigger Otomatis di Level Aplikasi (Backup jika trigger MySQL tidak aktif)
    protected static function booted()
    {
        $updateStock = function ($transaction) {
            $product = $transaction->product;
            if($product) {
                $in = $product->transactions()->where('type', 'in')->sum('quantity');
                $out = $product->transactions()->where('type', 'out')->sum('quantity');
                $product->current_stock = $product->initial_stock + $in - $out;
                $product->saveQuietly();
            }
        };

        static::saved($updateStock);
        static::deleted($updateStock);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}