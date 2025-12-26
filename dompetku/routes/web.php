<?php

use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController; // Tambahkan ini
use App\Http\Middleware\CekTipeUser;
use Illuminate\Support\Facades\Route;

// Rute Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Lindungi Rute dengan Middleware
Route::middleware([\App\Http\Middleware\CekSudahLogin::class])->group(function () {
    
    // Dashboard & Tambah
    Route::get('/', [TransaksiController::class, 'index']);
    Route::get('/transaksi/create', [TransaksiController::class, 'create']);
    Route::post('/transaksi', [TransaksiController::class, 'store']);

    // Rute Edit & Hapus (SOAL 1) - Tambahkan baris ini
    Route::get('/transaksi/{id}/edit', [TransaksiController::class, 'edit']);
    Route::put('/transaksi/{id}', [TransaksiController::class, 'update']);
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy']);

    // Rute Laporan (SOAL 4) - Diubah agar memanggil Controller
    Route::get('/laporan', [LaporanController::class, 'index'])->middleware(CekTipeUser::class);
});