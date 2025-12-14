@extends('layout.app')
@section('content')
<div class="container col-md-8">
    <div class="card">
        <div class="card-header fw-bold bg-warning">Edit Transaksi {{ $transaction->type == 'in' ? 'Masuk' : 'Keluar' }}</div>
        <div class="card-body">
            <form action="{{ route('w.transactions.update', [$warehouse->id, $transaction->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Barang (Tidak bisa diubah)</label>
                    <input type="text" class="form-control bg-light" value="{{ $transaction->product->name }}" readonly>
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label>Tanggal</label>
                        <input type="date" name="date" class="form-control" value="{{ $transaction->date }}" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label>Jumlah</label>
                        <input type="number" name="quantity" class="form-control" value="{{ $transaction->quantity }}" required min="1">
                        <small class="text-muted">Stok gudang akan otomatis disesuaikan.</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Satuan</label>
                    <input type="text" name="unit" class="form-control" value="{{ $transaction->unit }}">
                </div>

                <div class="mb-3">
                    <label>Keterangan</label>
                    <textarea name="remarks" class="form-control">{{ $transaction->remarks }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    
                    <button type="button" class="btn btn-danger" onclick="if(confirm('Yakin hapus transaksi ini? Stok akan dikembalikan.')) document.getElementById('del-form').submit()">
                        Hapus Transaksi
                    </button>
                </div>
            </form>

            <form id="del-form" action="{{ route('w.transactions.delete', [$warehouse->id, $transaction->id]) }}" method="POST" style="display:none">
                @csrf @method('DELETE')
            </form>
        </div>
    </div>
</div>
@endsection