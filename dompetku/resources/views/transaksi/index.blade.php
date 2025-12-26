@extends('layout.master')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Saldo</h3>
        <p class="mt-2 text-3xl font-bold text-gray-900">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-sm font-medium text-emerald-500 uppercase tracking-wider">Pemasukan</h3>
        <p class="mt-2 text-3xl font-bold text-emerald-600">+ Rp {{ number_format($pemasukan, 0, ',', '.') }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-sm font-medium text-rose-500 uppercase tracking-wider">Pengeluaran</h3>
        <p class="mt-2 text-3xl font-bold text-rose-600">- Rp {{ number_format($pengeluaran, 0, ',', '.') }}</p>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-800">Riwayat Transaksi Terakhir</h2>
        <a href="{{ url('/transaksi/create') }}" class="text-sm text-indigo-600 font-medium hover:underline">Tambah Baru</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 font-medium text-gray-500 text-sm">Tanggal</th>
            <th class="px-6 py-3 font-medium text-gray-500 text-sm">Keterangan</th>
            <th class="px-6 py-3 font-medium text-gray-500 text-sm">Kategori</th> <th class="px-6 py-3 font-medium text-gray-500 text-sm">Jenis</th>
            <th class="px-6 py-3 font-medium text-gray-500 text-sm text-right">Nominal</th>
            <th class="px-6 py-3 font-medium text-gray-500 text-sm text-center">Aksi</th> </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
        @foreach($dataTransaksi as $item)
        <tr class="hover:bg-gray-50 transition">
            <td class="px-6 py-4 text-sm text-gray-500">
                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
            </td>
            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                {{ $item->keterangan }}
            </td>
            <td class="px-6 py-4 text-sm text-gray-600">
                {{ $item->kategori->nama_kategori ?? 'Umum' }}
            </td>
            <td class="px-6 py-4 text-sm">
                @if($item->jenis == 'pemasukan')
                    <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">Pemasukan</span>
                @else
                    <span class="px-2 py-1 bg-rose-100 text-rose-700 rounded-full text-xs font-semibold">Pengeluaran</span>
                @endif
            </td>
            <td class="px-6 py-4 text-sm font-bold text-right {{ $item->jenis == 'pemasukan' ? 'text-emerald-600' : 'text-rose-600' }}">
                Rp {{ number_format($item->nominal, 0, ',', '.') }}
            </td>
            <td class="px-6 py-4 text-sm text-center">
                <div class="flex justify-center space-x-3">
                    <a href="{{ url('/transaksi/'.$item->id.'/edit') }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    <form action="{{ url('/transaksi/'.$item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-rose-600 hover:text-rose-900">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
        </div> <div class="mt-6">
        {{ $dataTransaksi->links() }}
    </div>
    </div>
</div>
@endsection