@extends('layout.app')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header fw-bold">Edit Barang: {{ $product->name }}</div>
        <div class="card-body">
            <form action="{{ route('w.products.update', [$warehouse->id, $product->id]) }}" method="POST">
                @csrf
                @method('PUT') <div class="row g-3">
                    <div class="col-md-6">
                        <label>Nama Barang</label>
                        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                    </div>
                    <div class="col-md-6">
                        <label>Kode Barang</label>
                        <input type="text" name="code" class="form-control" value="{{ $product->code }}">
                    </div>
                    <div class="col-md-6">
                        <label>Kategori</label>
                        <select name="category_id" class="form-select">
                            <option value="">Tanpa Kategori</option>
                            @foreach($categories as $c)
                                <option value="{{ $c->id }}" {{ $product->category_id == $c->id ? 'selected' : '' }}>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Stok Awal</label>
                        <input type="number" name="initial_stock" class="form-control" value="{{ $product->initial_stock }}">
                        <small class="text-muted">Mengubah ini akan merubah total Stok Gudang.</small>
                    </div>

                    @foreach($attributes as $attr)
                    <div class="col-md-6">
                        <label>{{ $attr->attribute_name }}</label>
                        <input type="text" 
                               name="attrs[{{ $attr->attribute_name }}]" 
                               class="form-control"
                               value="{{ $product->dynamic_attributes[$attr->attribute_name] ?? '' }}">
                    </div>
                    @endforeach

                    <div class="col-12">
                        <label>Keterangan</label>
                        <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-warning">Update Perubahan</button>
                    <a href="{{ route('w.products', $warehouse->id) }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection