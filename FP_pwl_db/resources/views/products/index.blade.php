@extends('layout.app')
@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-4">
        <h3 class="fw-bold">Data Barang</h3>
    </div>
    <div class="col-md-8">
        <div class="d-flex justify-content-end gap-2">
            <form action="{{ route('w.products', $warehouse->id) }}" method="GET" class="d-flex gap-2">
                
                <select name="sort" class="form-select" onchange="this.form.submit()" style="width: 180px;">
                    <option value="" disabled {{ !request('sort') ? 'selected' : '' }}>Urutkan...</option>
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                    <option value="code_asc" {{ request('sort') == 'code_asc' ? 'selected' : '' }}>Kode (A-Z)</option>
                    <option value="code_desc" {{ request('sort') == 'code_desc' ? 'selected' : '' }}>Kode (Z-A)</option>
                </select>

                <select name="category" class="form-select" onchange="this.form.submit()" style="width: 180px;">
                    <option value="">Semua Kategori</option>
                    
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" {{ request('category') == $c->id ? 'selected' : '' }}>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>

                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Cari barang..." value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                </div>
                
                @if(request('search') || request('sort') || request('category'))
                    <a href="{{ route('w.products', $warehouse->id) }}" class="btn btn-outline-danger" title="Reset Filter"><i class="bi bi-x-lg"></i></a>
                @endif
            </form>

            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    + Tambah
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalProduct">Barang Baru</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalCategory">Kelola Kategori</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalAttribute">Kelola Atribut</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle">
    <thead class="table-light">
        <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Stok</th>
            
            @foreach($attributes as $attr)
                <th>{{ $attr->attribute_name }}</th>
            @endforeach
            
            <th>Ket</th>
            
            <th class="text-center">Aksi</th> 
        </tr>
    </thead>

    <tbody>
        @forelse($products as $p)
        <tr>
            <td><span class="badge bg-light text-dark border">{{ $p->code }}</span></td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->category->name ?? '-' }}</td>
            <td class="fw-bold">{{ $p->current_stock }}</td>
            
            @foreach($attributes as $attr)
                <td>{{ $p->dynamic_attributes[$attr->attribute_name] ?? '-' }}</td>
            @endforeach
            
            <td><small class="text-muted">{{ $p->description }}</small></td>
            
            <td class="text-center">
    <div class="d-flex justify-content-center gap-1">
        <a href="{{ route('w.products.edit', [$warehouse->id, $p->id]) }}" class="btn btn-sm btn-warning" title="Edit">
            <i class="bi bi-pencil"></i>
        </a>
        
        <form action="{{ route('w.products.delete', [$warehouse->id, $p->id]) }}" method="POST" onsubmit="return confirm('Yakin hapus barang ini? \nPERINGATAN: Semua riwayat transaksi barang ini juga akan terhapus!')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    </div>
</td>
        </tr>
        @empty
        <tr>
            <td colspan="{{ 6 + count($attributes) }}" class="text-center py-4 text-muted">
                Belum ada data barang. Silakan tambah barang baru.
            </td>
        </tr>
        @endforelse
    </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalProduct">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('w.products.store', $warehouse->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header"><h5 class="modal-title">Tambah Barang</h5></div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label>Nama Barang</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Kode (Auto jika kosong)</label>
                            <input type="text" name="code" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Kategori</label>
                            <select name="category_id" class="form-select">
                                <option value="">Pilih...</option>
                                @foreach($categories as $c)
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Stok Awal</label>
                            <input type="number" name="initial_stock" class="form-control" value="0">
                        </div>
                        
                        @foreach($attributes as $attr)
                        <div class="col-md-6">
                            <label>{{ $attr->attribute_name }}</label>
                            <input type="text" name="attrs[{{ $attr->attribute_name }}]" class="form-control">
                        </div>
                        @endforeach
                        
                        <div class="col-12">
                            <label>Keterangan</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"><button class="btn btn-primary">Simpan</button></div>
            </div>
        </form>
    </div>
</div>

@include('products.partials_modals') 
@endsection