<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Models\Category;
use App\Models\Product;
use App\Models\CustomAttribute;
use App\Models\Transaction;
use Illuminate\Http\Request;

class WarehouseManagerController extends Controller
{
    // --- HALAMAN DEPAN ---
    public function splash() {
        return view('splash');
    }

    public function index() {
        $warehouses = Warehouse::all();
        return view('warehouses.index', compact('warehouses'));
    }

    public function storeWarehouse(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'location' => 'nullable'
        ]);
        Warehouse::create($data);
        return back()->with('success', 'Gudang berhasil dibuat');
    }

    // --- DASHBOARD GUDANG ---
    public function dashboard(Request $request, $id) {
        $warehouse = Warehouse::with(['products', 'categories'])->findOrFail($id);
        $totalProducts = $warehouse->products->count();
        $totalStock = $warehouse->products->sum('current_stock');
        
        // Query Dasar Transaksi
        $query = Transaction::whereHas('product', fn($q)=>$q->where('warehouse_id', $id))
                    ->with('product');

        // Logic Search di Dashboard
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('product', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        $recentTrx = $query->latest()->take(5)->get();
        
        return view('warehouses.dashboard', compact('warehouse', 'totalProducts', 'totalStock', 'recentTrx'));
    }

    // --- MANAJEMEN PRODUK & KATEGORI ---
    public function products(Request $request, $id) {
        $warehouse = Warehouse::findOrFail($id);
        $categories = Category::where('warehouse_id', $id)->get();
        $attributes = CustomAttribute::where('warehouse_id', $id)->get();
        
        // Query Dasar
        $query = Product::where('warehouse_id', $id)->with('category');

        // Logic Search (Nama / Kode)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        // --- 2. TAMBAHAN: LOGIC FILTER KATEGORI ---
        // Jika ada request 'category' dan tidak kosong
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }

        // Logic Filter / Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'name_asc': $query->orderBy('name', 'asc'); break;
                case 'name_desc': $query->orderBy('name', 'desc'); break;
                case 'code_asc': $query->orderBy('code', 'asc'); break;
                case 'code_desc': $query->orderBy('code', 'desc'); break;
                // Default: Terbaru (Created At)
                default: $query->latest(); break;
            }
        } else {
            $query->latest(); // Default jika tidak ada filter
        }

        $products = $query->get();
        
        return view('products.index', compact('warehouse', 'categories', 'attributes', 'products'));
    }

    // --- 3. TAMBAHAN: FUNGSI HAPUS BARANG ---
    public function destroyProduct($warehouseId, $productId) {
        $product = Product::where('warehouse_id', $warehouseId)->findOrFail($productId);
        
        // Hapus barang (Transaksi terkait akan ikut terhapus karena on delete cascade di migration)
        $product->delete();

        return back()->with('success', 'Barang dan riwayat transaksinya berhasil dihapus.');
    }

    public function storeProduct(Request $request, $id) {
        // Generate kode jika kosong
        $code = $request->code;
        if(empty($code)) {
            $code = 'BRG-' . strtoupper(uniqid()); 
        }

        Product::create([
            'warehouse_id' => $id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'code' => $code,
            'initial_stock' => $request->initial_stock ?? 0,
            'current_stock' => $request->initial_stock ?? 0,
            'description' => $request->description,
            'dynamic_attributes' => $request->attrs // Akan otomatis jadi JSON karena cast di Model
        ]);
        
        return back()->with('success', 'Barang berhasil ditambahkan');
    }

    public function storeCategory(Request $request, $id) {
        Category::create([
            'warehouse_id' => $id,
            'name' => $request->name
        ]);
        return back()->with('success', 'Kategori baru ditambahkan');
    }

    public function destroyCategory($warehouseId, $categoryId) {
        // Cari kategori yang mau dihapus (pastikan milik gudang yang sedang aktif)
        $category = Category::where('warehouse_id', $warehouseId)->findOrFail($categoryId);
        
        $category->delete();
        
        return back()->with('success', 'Kategori dihapus. Produk terkait sekarang berstatus "Tanpa Kategori".');
    }

    public function storeAttribute(Request $request, $id) {
        CustomAttribute::create([
            'warehouse_id' => $id,
            'attribute_name' => $request->attribute_name
        ]);
        return back()->with('success', 'Kolom kustom ditambahkan');
    }

    // --- TRANSAKSI ---
    public function transactions(Request $request, $id, $type) {
        $warehouse = Warehouse::findOrFail($id);
        $products = Product::where('warehouse_id', $id)->get();
        
        // Query Dasar
        // Kita join manual dengan tabel products agar bisa sort berdasarkan nama barang
        $query = Transaction::select('transactions.*')
                    ->join('products', 'transactions.product_id', '=', 'products.id')
                    ->where('products.warehouse_id', $id)
                    ->where('transactions.type', $type)
                    ->with('product');

        // Logic Search (Nama Barang / Kode Barang)
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('products.name', 'like', "%{$search}%")
                  ->orWhere('products.code', 'like', "%{$search}%");
            });
        }

        // Logic Filter / Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'name_asc': $query->orderBy('products.name', 'asc'); break;
                case 'name_desc': $query->orderBy('products.name', 'desc'); break;
                
                case 'qty_asc': $query->orderBy('transactions.quantity', 'asc'); break; // Sedikit
                case 'qty_desc': $query->orderBy('transactions.quantity', 'desc'); break; // Terbanyak
                
                case 'date_asc': $query->orderBy('transactions.date', 'asc'); break; // Terlama
                case 'date_desc': $query->orderBy('transactions.date', 'desc'); break; // Terbaru
                
                default: $query->orderBy('transactions.date', 'desc')->orderBy('transactions.created_at', 'desc'); break;
            }
        } else {
            // Default: Tanggal terbaru
            $query->orderBy('transactions.date', 'desc')->orderBy('transactions.created_at', 'desc');
        }

        $transactions = $query->get();
        
        return view('transactions.index', compact('warehouse', 'transactions', 'products', 'type'));
    }

    public function storeTransaction(Request $request, $id, $type) {
        // Cari produk berdasarkan nama atau kode di gudang ini
        $product = Product::where('warehouse_id', $id)
                    ->where(function($q) use ($request) {
                        $q->where('code', $request->product_ref)
                          ->orWhere('name', $request->product_ref);
                    })->first();

        if(!$product) {
            return back()->with('error', 'Barang tidak ditemukan! Pastikan nama/kode benar.');
        }

        Transaction::create([
            'product_id' => $product->id,
            'type' => $type,
            'quantity' => $request->quantity,
            'date' => $request->date,
            'unit' => $request->unit,
            'remarks' => $request->remarks
        ]);

        return back()->with('success', 'Stok berhasil diupdate');
    }

    // --- TAMBAHAN: EDIT DATA BARANG ---
    
    public function editProduct($warehouseId, $productId) {
        $warehouse = Warehouse::findOrFail($warehouseId);
        $product = Product::where('warehouse_id', $warehouseId)->findOrFail($productId);
        $categories = Category::where('warehouse_id', $warehouseId)->get();
        $attributes = CustomAttribute::where('warehouse_id', $warehouseId)->get();
        
        return view('products.edit', compact('warehouse', 'product', 'categories', 'attributes'));
    }

    public function updateProduct(Request $request, $warehouseId, $productId) {
        $product = Product::where('warehouse_id', $warehouseId)->findOrFail($productId);
        
        $request->validate([
            'name' => 'required|string',
            'initial_stock' => 'required|integer|min:0',
        ]);

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'code' => $request->code ?? $product->code, // Pakai kode lama jika kosong
            'initial_stock' => $request->initial_stock,
            'description' => $request->description,
            'dynamic_attributes' => $request->attrs 
        ]);
        
        // Trigger update stok manual agar current_stock sinkron dengan initial_stock baru
        $product->touch(); 
        $product->save(); // Memicu kalkulasi ulang di model Transaction (via relasi)
        
        // Kalkulasi manual (Safety net)
        $in = $product->transactions()->where('type', 'in')->sum('quantity');
        $out = $product->transactions()->where('type', 'out')->sum('quantity');
        $product->current_stock = $request->initial_stock + $in - $out;
        $product->save();

        return redirect()->route('w.products', $warehouseId)->with('success', 'Data barang berhasil diperbarui');
    }

    // --- TAMBAHAN: EDIT TRANSAKSI ---

    public function editTransaction($warehouseId, $trxId) {
        $warehouse = Warehouse::findOrFail($warehouseId);
        $transaction = Transaction::findOrFail($trxId);
        
        return view('transactions.edit', compact('warehouse', 'transaction'));
    }

    public function updateTransaction(Request $request, $warehouseId, $trxId) {
        $transaction = Transaction::findOrFail($trxId);
        
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date'
        ]);

        $transaction->update([
            'quantity' => $request->quantity,
            'date' => $request->date,
            'unit' => $request->unit,
            'remarks' => $request->remarks
        ]);
        
        // Stok produk akan otomatis terupdate berkat logic di Model Transaction

        return redirect()->route('w.transactions', [$warehouseId, $transaction->type])
                         ->with('success', 'Transaksi berhasil diedit & stok diperbarui');
    }
    
    public function deleteTransaction($warehouseId, $trxId) {
        $transaction = Transaction::findOrFail($trxId);
        $type = $transaction->type;
        $transaction->delete(); // Stok produk otomatis kembali seperti semula
        
        return redirect()->route('w.transactions', [$warehouseId, $type])
                         ->with('success', 'Transaksi dihapus & stok dikembalikan');
    }
}