<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KampanyeSosialController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\RiwayatController;

// ROUTE INCREMENT 1 (Publik & Kampanye)
Route::get('/', [KampanyeSosialController::class, 'home']);
Route::get('/kampanye', [KampanyeSosialController::class, 'index']);
Route::get('/kampanye/{id}', [KampanyeSosialController::class, 'show']);
Route::post('/kampanye/{id}/donasi', [DonasiController::class, 'store'])
    ->middleware('donatur')
    ->name('donasi.store');


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

Route::get('/pengelola/dashboard', function () {
    return 'Dashboard Pengelola';
})->middleware('pengelola');


// Midtrans route
Route::post('/midtrans/callback', [DonasiController::class, 'callback'])
      ->name('midtrans.callback');


// ROUTE INCREMENT 4 (Publik & Donatur)
// Area Publik (Leaderboard)
Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
Route::get('/riwayat', [RiwayatController::class, 'index'])
    ->middleware('donatur')
    ->name('riwayat.index');
