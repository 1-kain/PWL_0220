@extends('layout.app')
@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-4">
        <h3 class="fw-bold">Stok {{ $type == 'in' ? 'Masuk' : 'Keluar' }}</h3>
    </div>
    <div class="col-md-8">
        <div class="d-flex justify-content-end gap-2">
            
            <form action="{{ route('w.transactions', [$warehouse->id, $type]) }}" method="GET" class="d-flex gap-2">
                
                <select name="sort" class="form-select" onchange="this.form.submit()" style="width: 220px;">
                    <option value="" disabled {{ !request('sort') ? 'selected' : '' }}>Filter...</option>
                    <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Tanggal Terbaru (Desc)</option>
                    <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>Tanggal Terlama (Asc)</option>
                    <option value="qty_desc" {{ request('sort') == 'qty_desc' ? 'selected' : '' }}>Jumlah Terbanyak (Desc)</option>
                    <option value="qty_asc" {{ request('sort') == 'qty_asc' ? 'selected' : '' }}>Jumlah Tersedikit (Asc)</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama Barang (A-Z)</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama Barang (Z-A)</option>
                </select>

                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama/kode..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                </div>

                @if(request('search') || request('sort'))
                    <a href="{{ route('w.transactions', [$warehouse->id, $type]) }}" class="btn btn-outline-danger" title="Reset"><i class="bi bi-x-lg"></i></a>
                @endif
            </form>

            <button class="btn btn-{{ $type == 'in' ? 'success' : 'danger' }}" data-bs-toggle="modal" data-bs-target="#trxModal">
                + Input
            </button>
        </div>
    </div>
</div>

@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
@if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

<div class="card">
    <div class="card-body">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Ket</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $t)
                <tr>
    <td>{{ \Carbon\Carbon::parse($t->date)->format('d M Y') }}</td>
    <td>{{ $t->product->name }}</td>
    <td class="fw-bold {{ $type == 'in' ? 'text-success' : 'text-danger' }}">{{ $t->quantity }}</td>
    <td>{{ $t->unit }}</td>
    <td>{{ $t->remarks }}</td>
    
    <td>
        <a href="{{ route('w.transactions.edit', [$warehouse->id, $t->id]) }}" class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-pencil-square"></i>
        </a>
    </td>
</tr>
                @empty
                <tr><td colspan="5" class="text-center">Belum ada data transaksi</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="trxModal">
    <div class="modal-dialog">
        <form action="{{ route('w.transactions.store', [$warehouse->id, $type]) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-{{ $type == 'in' ? 'success' : 'danger' }} text-white">
                    <h5 class="modal-title">Input Stok {{ $type == 'in' ? 'Masuk' : 'Keluar' }}</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Nama / Kode Barang</label>
                        <input list="products" name="product_ref" class="form-control" placeholder="Ketik nama..." required autocomplete="off">
                        <datalist id="products">
                            @foreach($products as $p)
                                <option value="{{ $p->name }}">{{ $p->code }}</option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label>Tanggal</label>
                            <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label>Jumlah</label>
                            <input type="number" name="quantity" class="form-control" required min="1">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label>Keterangan</label>
                        <textarea name="remarks" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-{{ $type == 'in' ? 'success' : 'danger' }}">Simpan</button></div>
            </div>
        </form>
    </div>
</div>
@endsection