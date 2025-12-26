<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    public function up(): void
{
    Schema::create('kategoris', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kategori'); // Contoh: Makanan, Transportasi, Gaji
        $table->text('deskripsi')->nullable();
        $table->timestamps();
    });
}

public function transaksi()
{
    return $this->hasMany(Transaksi::class);
}
}
