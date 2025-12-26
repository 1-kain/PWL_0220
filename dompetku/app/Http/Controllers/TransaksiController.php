<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kategori; // Penting untuk Soal 3
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // Menampilkan Dashboard dengan Pencarian & Pagination (Soal 2)
    public function index(Request $request) {
        $query = Transaksi::with('kategori'); // Eager loading relasi

        if ($request->has('search')) {
            $query->where('keterangan', 'like', '%' . $request->search . '%');
        }

        // Menggunakan paginate(10) bukan get() agar tidak lag [cite: 145]
        $transaksi = $query->orderBy('tanggal', 'desc')->paginate(10);

        $totalPemasukan = Transaksi::where('jenis', 'pemasukan')->sum('nominal');
        $totalPengeluaran = Transaksi::where('jenis', 'pengeluaran')->sum('nominal');

        return view('transaksi.index', [
            'dataTransaksi' => $transaksi,
            'pemasukan' => $totalPemasukan,
            'pengeluaran' => $totalPengeluaran,
            'saldo' => $totalPemasukan - $totalPengeluaran
        ]);
    }

    // Menampilkan Form Tambah (PENTING: Jangan dihapus/dilewati) [cite: 118]
    public function create() {
        $kategoris = Kategori::all(); // Ambil data untuk dropdown [cite: 156]
        return view('transaksi.create', compact('kategoris'));
    }

    // Menyimpan data baru ke DB (Latihan 11.4.5) [cite: 120]
    public function store(Request $request) {
        $validated = $request->validate([
            'keterangan' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:1000',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'tanggal' => 'required|date',
            'kategori_id' => 'nullable|exists:kategoris,id'
        ]);

        Transaksi::create($validated);
        return redirect('/')->with('success', 'Transaksi berhasil disimpan!');
    }

    // Menampilkan Form Edit (Soal 1) [cite: 138]
    public function edit($id) {
        $transaksi = Transaksi::findOrFail($id);
        $kategoris = Kategori::all();
        return view('transaksi.edit', compact('transaksi', 'kategoris'));
    }

    // Memperbarui data (Soal 1) [cite: 139]
    public function update(Request $request, $id) {
        $validated = $request->validate([
            'keterangan' => 'required',
            'nominal' => 'required|numeric',
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'tanggal' => 'required|date',
            'kategori_id' => 'nullable|exists:kategoris,id'
        ]);

        Transaksi::findOrFail($id)->update($validated);
        return redirect('/')->with('success', 'Data berhasil diperbarui!');
    }

    // Menghapus data (Soal 1) [cite: 142]
    public function destroy($id) {
        Transaksi::findOrFail($id)->delete();
        return redirect('/')->with('success', 'Data berhasil dihapus!');
    }
}