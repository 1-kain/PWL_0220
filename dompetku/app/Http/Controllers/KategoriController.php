<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function store(Request $request) {
    $request->validate(['nama_kategori' => 'required|unique:kategoris,nama_kategori']);
    \App\Models\Kategori::create($request->all());
    return back()->with('success', 'Kategori baru berhasil ditambahkan!');
}
}
