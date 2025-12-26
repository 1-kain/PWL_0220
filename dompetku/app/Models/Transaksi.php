<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Mendefinisikan kolom yang boleh diisi oleh user
    protected $fillable = ['keterangan', 'tanggal', 'nominal', 'jenis', 'kategori_id'];

    public function kategori()
{
    return $this->belongsTo(Kategori::class);
}
}