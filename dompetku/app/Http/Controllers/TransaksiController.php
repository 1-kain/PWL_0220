<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Menampilkan halaman Dashboard
    public function index()
    {
        // Simulasi Data Transaksi (Array Statis)
        // Nantinya ini diambil dari Database
        $transaksi = [
            [
                'id' => 1,
                'keterangan' => 'Gaji Bulanan',
                'nominal' => 5000000,
                'jenis' => 'pemasukan',
                'tanggal' => '2023-10-01'
            ],
            [
                'id' => 2,
                'keterangan' => 'Bayar Listrik',
                'nominal' => 350000,
                'jenis' => 'pengeluaran',
                'tanggal' => '2023-10-05'
            ],
            [
                'id' => 3,
                'keterangan' => 'Beli Kopi',
                'nominal' => 25000,
                'jenis' => 'pengeluaran',
                'tanggal' => '2023-10-06'
            ],
        ];

        // Hitung total saldo sederhana
        $totalPemasukan = 5000000;
        $totalPengeluaran = 375000;
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('transaksi.index', [
            'dataTransaksi' => $transaksi,
            'saldo' => $saldo,
            'pemasukan' => $totalPemasukan,
            'pengeluaran' => $totalPengeluaran
        ]);
    }

    // Menampilkan Form Tambah Data
    public function create()
    {
        return view('transaksi.create');
    }

    // Memproses Data Input (Request & Validation)
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'keterangan' => 'required|min:5|max:100',
            'nominal' => 'required|numeric|min:1000',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'tanggal' => 'required|date'
        ]);

        // 2. Logika Penyimpanan (Simulasi)
        // Karena belum ada DB, kita akan me-redirect dengan pesan sukses.
        // Di modul 11, kode ini diganti dgn: Transaksi::create($validated);
        
        // 3. Response Redirect
        return redirect('/')->with('success', 'Data transaksi berhasil ditambahkan (Simulasi)!');
    }

    public function laporan(Request $request)
    {
        // Cek parameter VIP (sesuai praktikum sebelumnya)
        if ($request->query('type') !== 'vip') {
            return redirect('/')->with('error', 'Akses Ditolak! Fitur khusus VIP.');
        }

        $chartData = [
            'labels' => ['Pemasukan', 'Pengeluaran', 'Tabungan'],
            'data'   => [5000000, 3500000, 1500000],
        ];

        // Perhatikan bagian 'laporan' ini
        return view('laporan', compact('chartData'));
    }
}