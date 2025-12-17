<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;
// use App\Http\Middleware\CekTipeUser; // (Opsional: Aktifkan jika butuh cek VIP spesifik)

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. Rute Autentikasi (Login/Logout) ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- 2. Rute yang Perlu Login (Dilindungi Middleware) ---
Route::middleware([App\Http\Middleware\CekSudahLogin::class])->group(function () {
    
    // Dashboard
    Route::get('/', [TransaksiController::class, 'index']); 
    
    // CRUD Transaksi
    Route::get('/transaksi/create', [TransaksiController::class, 'create']);
    Route::post('/transaksi', [TransaksiController::class, 'store']);
    
    // === RUTE BARU UNTUK HALAMAN LAPORAN VIP ===
    // Ini menghubungkan URL '/laporan' ke function 'laporan' di TransaksiController
    Route::get('/laporan', [TransaksiController::class, 'laporan'])->name('laporan.vip');

});