<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemPenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenisController;

// Otomatis diarahkan ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rute Tampilan Login & Proses Autentikasi
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'auth'])->name('auth');

// Rute yang hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {

    // Dashboard Umum setelah login
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Halaman Tentang (bisa diakses semua role yang sudah login)
    Route::get('/tentang', function () {
        return view('tentang');
    })->name('tentang');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ===================================================
    // KHUSUS ADMIN — users
    // ===================================================
    Route::middleware('role:Admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // ===================================================
    // PRODUK, PENJUALAN, ITEM PENJUALAN — bisa diakses Admin & Kasir
    // (pembatasan create/update/delete lebih rinci diatur lewat Policy)
    // ===================================================
    Route::middleware('role:Admin,Kasir')->group(function () {
        Route::resource('produk', ProdukController::class);
        Route::resource('penjualan', PenjualanController::class);
        Route::resource('itempenjualan', ItemPenjualanController::class);
    });

    // ===================================================
    // JENIS — khusus Admin
    // ===================================================
    Route::middleware('role:Admin')->group(function () {
        Route::resource('jenis', JenisController::class);
    });
});