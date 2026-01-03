@extends('layout.master')

@section('title', 'Tambah Transaksi')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Tambah Transaksi Baru</h2>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/transaksi') }}" method="POST">
            @csrf 
            <div class="space-y-5">
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Kategori</label>
                    <select name="kategori_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border">
                        <option value="">-- Tanpa Kategori --</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-400 mt-1 italic">*Kategori belum ada? Tambahkan di kotak bawah.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan Transaksi</label>
                    <input type="text" name="keterangan" value="{{ old('keterangan') }}" 
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border" 
                        placeholder="Contoh: Beli Nasi Goreng">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nominal (Rp)</label>
                        <input type="number" name="nominal" value="{{ old('nominal') }}" 
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border" 
                            placeholder="0">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" 
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Transaksi</label>
                    <div class="flex space-x-4">
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 w-full">
                            <input type="radio" name="jenis" value="pemasukan" class="text-indigo-600 focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-700">Pemasukan</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 w-full">
                            <input type="radio" name="jenis" value="pengeluaran" checked class="text-indigo-600 focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-700">Pengeluaran</span>
                        </label>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-indigo-700 transition duration-200">
                        Simpan Transaksi
                    </button>
                </div>
            </div>
        </form>

        <div class="relative my-10">
            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                <div class="w-full border-t border-gray-100"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-400">Atau Tambah Kategori Baru</span>
            </div>
        </div>
        
        <div class="bg-gray-50 p-6 rounded-xl border border-dashed border-gray-300">
            <form action="{{ url('/kategori') }}" method="POST" class="flex flex-col md:flex-row gap-2">
                @csrf
                <input type="text" name="nama_kategori" required placeholder="Nama Kategori (misal: Kesehatan)" 
                    class="flex-1 rounded-lg border-gray-300 shadow-sm p-2.5 text-sm border focus:ring-indigo-500">
                <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-lg text-sm font-semibold hover:bg-black transition">
                    + Tambah
                </button>
            </form>
        </div>
    </div>
</div>
@endsection