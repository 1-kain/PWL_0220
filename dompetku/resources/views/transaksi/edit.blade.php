@extends('layout.master')

@section('title', 'Edit Transaksi')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Edit Transaksi</h2>

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/transaksi/' . $transaksi->id) }}" method="POST">
            @csrf 
            @method('PUT') <div class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select name="kategori_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border">
                        <option value="">-- Tanpa Kategori --</option>
                        @foreach($kategoris as $kat)
                            <option value="{{ $kat->id }}" {{ $transaksi->kategori_id == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                    <input type="text" name="keterangan" value="{{ $transaksi->keterangan }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nominal (Rp)</label>
                        <input type="number" name="nominal" value="{{ $transaksi->nominal }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ $transaksi->tanggal }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2.5 border">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Transaksi</label>
                    <div class="flex space-x-4">
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 w-full">
                            <input type="radio" name="jenis" value="pemasukan" {{ $transaksi->jenis == 'pemasukan' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-700">Pemasukan</span>
                        </label>
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-gray-50 w-full">
                            <input type="radio" name="jenis" value="pengeluaran" {{ $transaksi->jenis == 'pengeluaran' ? 'checked' : '' }} class="text-indigo-600 focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-700">Pengeluaran</span>
                        </label>
                    </div>
                </div>

                <div class="pt-4 flex space-x-3">
                    <a href="{{ url('/') }}" class="w-full text-center bg-gray-100 text-gray-700 font-bold py-3 px-4 rounded-lg hover:bg-gray-200 transition duration-200">
                        Batal
                    </a>
                    <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-indigo-700 transition duration-200">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection