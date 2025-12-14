<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomAttribute extends Model
{
    protected $guarded = [];

    public function warehouse() {
        return $this->belongsTo(Warehouse::class);
    }
}