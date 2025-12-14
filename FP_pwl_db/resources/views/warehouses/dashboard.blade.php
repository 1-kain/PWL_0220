@extends('layout.app')
@section('content')
<h3 class="fw-bold mb-4">Dashboard Overview</h3>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white h-100">
            <div class="card-body">
                <h6>Total Barang</h6>
                <h2 class="fw-bold">{{ $totalProducts }} Item</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="text-muted">Total Stok Fisik</h6>
                <h2 class="fw-bold text-dark">{{ $totalStock }} Unit</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body">
                <h6 class="text-muted">Jumlah Kategori</h6>
                <h2 class="fw-bold text-dark">{{ $warehouse->categories->count() }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <span class="fw-bold">Riwayat Transaksi Terakhir</span>
        
        <form action="{{ route('w.dashboard', $warehouse->id) }}" method="GET" class="d-flex" style="width: 300px;">
            <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari nama/kode..." value="{{ request('search') }}">
            <button class="btn btn-sm btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
            
            @if(request('search'))
                <a href="{{ route('w.dashboard', $warehouse->id) }}" class="btn btn-sm btn-outline-secondary ms-1" title="Reset"><i class="bi bi-x"></i></a>
            @endif
        </form>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Tipe</th>
                    <th>Barang</th>
                    <th>Qty</th>
                    <th>Ket</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTrx as $trx)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($trx->date)->format('d M Y') }}</td>
                    <td>
                        <span class="badge bg-{{ $trx->type == 'in' ? 'success' : 'danger' }}">
                            {{ $trx->type == 'in' ? 'Masuk' : 'Keluar' }}
                        </span>
                    </td>
                    <td>{{ $trx->product->name }}</td>
                    <td class="fw-bold">{{ $trx->quantity }}</td>
                    <td>{{ $trx->remarks }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-3">Belum ada transaksi</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection