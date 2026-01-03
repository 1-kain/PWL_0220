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

    $dataGrafik = Transaksi::where('jenis', 'pengeluaran')
        ->where('tanggal', '>=', now()->subDays(7))
        ->selectRaw('tanggal, sum(nominal) as total')
        ->groupBy('tanggal')
        ->orderBy('tanggal', 'asc')
        ->get();

    $labels = $dataGrafik->pluck('tanggal')->toArray(); 
    $values = $dataGrafik->pluck('total')->toArray();  

    return view('laporan', compact('pemasukan', 'pengeluaran', 'tabungan', 'labels', 'values'));
}
}