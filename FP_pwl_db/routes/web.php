<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarehouseManagerController;

Route::get('/', [WarehouseManagerController::class, 'splash'])->name('splash');
Route::get('/warehouses', [WarehouseManagerController::class, 'index'])->name('home');
Route::post('/warehouses', [WarehouseManagerController::class, 'storeWarehouse'])->name('warehouses.store');

// Grouping Routes berdasarkan ID Gudang
Route::prefix('warehouse/{id}')->group(function(){
    
    // Dashboard
    Route::get('/dashboard', [WarehouseManagerController::class, 'dashboard'])->name('w.dashboard');
    
    // Produk, Kategori, Atribut
    Route::get('/products', [WarehouseManagerController::class, 'products'])->name('w.products');
    Route::post('/products', [WarehouseManagerController::class, 'storeProduct'])->name('w.products.store');
    
    Route::post('/category', [WarehouseManagerController::class, 'storeCategory'])->name('w.category.store');
    Route::post('/attribute', [WarehouseManagerController::class, 'storeAttribute'])->name('w.attribute.store');

    // Transaksi (Masuk / Keluar)
    Route::get('/transactions/{type}', [WarehouseManagerController::class, 'transactions'])->name('w.transactions');
    Route::post('/transactions/{type}', [WarehouseManagerController::class, 'storeTransaction'])->name('w.transactions.store');

    // EDIT BARANG
    Route::get('/products/{productId}/edit', [WarehouseManagerController::class, 'editProduct'])->name('w.products.edit');
    Route::put('/products/{productId}', [WarehouseManagerController::class, 'updateProduct'])->name('w.products.update');

    // EDIT TRANSAKSI
    Route::get('/transaction/{trxId}/edit', [WarehouseManagerController::class, 'editTransaction'])->name('w.transactions.edit');
    Route::put('/transaction/{trxId}', [WarehouseManagerController::class, 'updateTransaction'])->name('w.transactions.update');
    
    // HAPUS TRANSAKSI (Opsional tapi penting)
    Route::delete('/transaction/{trxId}', [WarehouseManagerController::class, 'deleteTransaction'])->name('w.transactions.delete');

    // Simpan Kategori (Sudah ada)
    Route::post('/category', [WarehouseManagerController::class, 'storeCategory'])->name('w.category.store');
    
    // TAMBAHAN: Hapus Kategori
    Route::delete('/category/{categoryId}', [WarehouseManagerController::class, 'destroyCategory'])->name('w.category.delete');

    Route::put('/products/{productId}', [WarehouseManagerController::class, 'updateProduct'])->name('w.products.update');
    
    // TAMBAHAN: Route Hapus Barang
    Route::delete('/products/{productId}', [WarehouseManagerController::class, 'destroyProduct'])->name('w.products.delete');

    Route::post('/attribute', [WarehouseManagerController::class, 'storeAttribute'])->name('w.attribute.store');
    
    // TAMBAHAN: Route Hapus Atribut
    Route::delete('/attribute/{attrId}', [WarehouseManagerController::class, 'destroyAttribute'])->name('w.attribute.delete');
});