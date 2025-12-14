<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MADANG - Warehouse System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f3f4f6; font-family: sans-serif; }
        .sidebar { width: 260px; height: 100vh; position: fixed; background: white; border-right: 1px solid #e5e7eb; padding: 20px; }
        .main-content { margin-left: 260px; padding: 30px; }
        .nav-link { color: #374151; padding: 10px; border-radius: 8px; margin-bottom: 5px; display: block; text-decoration: none; }
        .nav-link:hover, .nav-link.active { background-color: #eef2ff; color: #4f46e5; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); background: white; margin-bottom: 20px; padding: 20px; }
    </style>
</head>
<body>
    @if(!request()->routeIs('splash') && !request()->routeIs('home'))
    <div class="sidebar">
        <h4 class="fw-bold text-primary mb-4"><i class="bi bi-box-seam-fill"></i> MADANG</h4>
        <small class="text-muted">Gudang Aktif:</small>
        <div class="fw-bold mb-4">{{ $warehouse->name ?? '...' }}</div>
        
        <nav>
            <a href="{{ route('w.dashboard', $warehouse->id) }}" class="nav-link"><i class="bi bi-grid"></i> Dashboard</a>
            <a href="{{ route('w.products', $warehouse->id) }}" class="nav-link"><i class="bi bi-box"></i> Data Barang</a>
            <a href="{{ route('w.transactions', [$warehouse->id, 'in']) }}" class="nav-link"><i class="bi bi-arrow-down-circle"></i> Stok Masuk</a>
            <a href="{{ route('w.transactions', [$warehouse->id, 'out']) }}" class="nav-link"><i class="bi bi-arrow-up-circle"></i> Stok Keluar</a>
            <hr>
            <a href="{{ route('home') }}" class="nav-link text-danger"><i class="bi bi-arrow-left"></i> Ganti Gudang</a>
        </nav>
    </div>
    <div class="main-content">
        @yield('content')
    </div>
    @else
        @yield('content')
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>