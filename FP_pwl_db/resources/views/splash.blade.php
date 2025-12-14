@extends('layout.app')
@section('content')
<div class="d-flex justify-content-center align-items-center vh-100 bg-primary">
    <div class="text-center text-white">
        <i class="bi bi-box-seam-fill" style="font-size: 5rem;"></i>
        <h1 class="display-3 fw-bold mt-3">MADANG</h1>
        <p class="lead mb-5">Sistem Manajemen Gudang & Stok Terpadu</p>
        <a href="{{ route('home') }}" class="btn btn-light btn-lg fw-bold rounded-pill px-5 shadow">
            Mulai Sekarang
        </a>
    </div>
</div>
@endsection