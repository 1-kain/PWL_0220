<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    \App\Models\Kategori::insert([
        ['nama_kategori' => 'Makanan & Minuman'],
        ['nama_kategori' => 'Transportasi'],
        ['nama_kategori' => 'Gaji'],
        ['nama_kategori' => 'Hiburan'],
    ]);
}
}
