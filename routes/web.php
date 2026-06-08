<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\KampanyeSosialController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\PengelolaAdminController;
use App\Http\Controllers\PengelolaDashboardController;
use App\Http\Controllers\PengelolaDonasiController;
use App\Http\Controllers\PengelolaDonaturController;
use App\Http\Controllers\PengelolaKampanyeController;
use App\Http\Controllers\PengelolaLaporanController;
use App\Http\Controllers\PengelolaPenerimaController;
use App\Http\Controllers\ProfilDonaturController;
use App\Http\Controllers\RiwayatController;
use Illuminate\Support\Facades\Route;

// ROUTE INCREMENT 1 (Publik & Kampanye)
Route::get('/', [KampanyeSosialController::class, 'home']);
Route::get('/kampanye', [KampanyeSosialController::class, 'index']);
Route::get('/kampanye/{id}', [KampanyeSosialController::class, 'show']);
Route::post('/kampanye/{id}/donasi', [DonasiController::class, 'store'])
    ->middleware('donatur')
    ->name('donasi.store');

// Halaman informasi publik
Route::view('/tentang-kami', 'tentang-kami')->name('tentang-kami');
Route::view('/hubungi-kami', 'hubungi-kami')->name('hubungi-kami');
Route::view('/kebijakan-privasi', 'kebijakan-privasi')->name('kebijakan-privasi');
Route::view('/syarat-ketentuan', 'syarat-ketentuan')->name('syarat-ketentuan');

// ROUTE INCREMENT 2 (Auth Donatur & Pengelola)
// Auth Routes
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Sementara (Diberi Middleware)
Route::get('/donatur/dashboard', function () {
    return 'Dashboard Donatur';
})->middleware('donatur');

Route::middleware('pengelola')->prefix('pengelola')->name('pengelola.')->group(function () {
    Route::get('/dashboard', [PengelolaDashboardController::class, 'index'])->name('dashboard');

    Route::get('/donasi', [PengelolaDonasiController::class, 'index'])->name('donasi.index');
    Route::get('/donasi/{id}', [PengelolaDonasiController::class, 'show'])->name('donasi.show');
    Route::put('/donasi/{id}/status', [PengelolaDonasiController::class, 'updateStatus'])->name('donasi.update-status');

    Route::resource('kampanye', PengelolaKampanyeController::class);
    Route::resource('penerima', PengelolaPenerimaController::class);
    Route::resource('laporan', PengelolaLaporanController::class);
    Route::resource('donatur', PengelolaDonaturController::class);
    Route::resource('admin', PengelolaAdminController::class)->middleware('admin_utama');
});

Route::middleware('donatur')->group(function () {
    Route::get('/profil', [ProfilDonaturController::class, 'show'])->name('donatur.profil');
    Route::put('/profil', [ProfilDonaturController::class, 'update'])->name('donatur.profil.update');
    Route::put('/profil/password', [ProfilDonaturController::class, 'updatePassword'])->name('donatur.profil.password');
});
// Midtrans route
Route::post('/midtrans/callback', [DonasiController::class, 'callback'])
    ->name('midtrans.callback');

// ROUTE INCREMENT 4 (Publik & Donatur)
// Area Publik (Leaderboard)
Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
Route::get('/riwayat-donasi', [RiwayatController::class, 'index'])
    ->middleware('donatur')
    ->name('donatur.riwayat');
