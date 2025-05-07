<?php

use Illuminate\Session\TokenMismatchException;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AdminProdukController;
use App\Http\Controllers\AdminTransaksiDetail;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;

Route::bind('role', function ($value) {
    return Role::where('id', $value)->firstOrFail();
});

// Rute login
Route::get('/login', [AdminAuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login/do', [AdminAuthController::class, 'doLogin'])->middleware('guest');
Route::get('logout', [AdminAuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminAuthController::class, 'index']);
});

// Rute Admin Dashboard
Route::prefix('admin')->middleware('auth')->group(function () {
    
    // Rute lainnya
    Route::post('/transaksi/detail/create', [AdminTransaksiDetail::class, 'create']);
    Route::resource('/transaksi', AdminTransaksiController::class);
    Route::resource('/produk', AdminProdukController::class);
    Route::resource('/kategori', AdminKategoriController::class);
    Route::resource('/user', AdminUserController::class);
});
