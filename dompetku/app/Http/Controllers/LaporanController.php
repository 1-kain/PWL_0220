<?php

namespace App\Http\Controllers;

use App\Models\Transaksi; // Import Model Transaksi
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index() {
    $pemasukan = Transaksi::where('jenis', 'pemasukan')->sum('nominal');
    $pengeluaran = Transaksi::where('jenis', 'pengeluaran')->sum('nominal');
    $tabungan = $pemasukan - $pengeluaran;

    return view('laporan', compact('pemasukan', 'pengeluaran', 'tabungan'));
}
}