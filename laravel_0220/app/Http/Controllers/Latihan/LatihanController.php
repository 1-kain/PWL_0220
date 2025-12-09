<?php

namespace App\Http\Controllers\Latihan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LatihanController extends Controller
{
    public function coba()
    {
        $nama = 'John Doe';
        $data = ['namaOrang' => $nama];
        return view('coba.profil', $data);
    }
}
