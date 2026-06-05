<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KampanyeSosialController;
use App\Http\Controllers\AuthController; 


// ROUTE INCREMENT 1 (Publik & Kampanye)
Route::get('/', [KampanyeSosialController::class, 'home']);
Route::get('/kampanye', [KampanyeSosialController::class, 'index']);
Route::get('/kampanye/{id}', [KampanyeSosialController::class, 'show']);


// ROUTE INCREMENT 2 (Auth Donatur & Pengelola)
// Auth Routes
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Dashboard Sementara (Diberi Middleware)
Route::get('/donatur/dashboard', function () {
    return 'Dashboard Donatur';
})->middleware('donatur');

Route::get('/pengelola/dashboard', function () {
    return 'Dashboard Pengelola';
})->middleware('pengelola');
// Route untuk Detail Kampanye
Route::get('/kampanye/{id}', [KampanyeSosialController::class, 'show']);

Route::get('/login', function () {return view('auth.login');});
