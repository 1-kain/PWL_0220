@extends('layout.app')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Pilih Gudang</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newWarehouse">
            + Buat Gudang Baru
        </button>
    </div>

    @if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

    <div class="row">
        @foreach($warehouses as $w)
        <div class="col-md-4 mb-4">
            <a href="{{ route('w.dashboard', $w->id) }}" class="text-decoration-none">
                <div class="card h-100 shadow-sm hover-shadow p-3">
                    <div class="d-flex align-items-center">
                        <div class="bg-light text-primary rounded p-3 me-3">
                            <i class="bi bi-building fs-3"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">{{ $w->name }}</h5>
                            <small class="text-muted">{{ $w->location ?? 'Lokasi tidak diset' }}</small>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>

<div class="modal fade" id="newWarehouse">
    <div class="modal-dialog">
        <form action="{{ route('warehouses.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Gudang Baru</h5></div>
                <div class="modal-body">
                    <input type="text" name="name" class="form-control mb-2" placeholder="Nama Gudang" required>
                    <input type="text" name="location" class="form-control" placeholder="Lokasi (Opsional)">
                </div>
                <div class="modal-footer"><button class="btn btn-primary">Simpan</button></div>
            </div>
        </form>
    </div>
</div>
@endsection