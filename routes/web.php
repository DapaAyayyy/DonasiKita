<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KampanyeSosialController;

// Route untuk Landing Page
Route::get('/', [KampanyeSosialController::class, 'home']);

// Route untuk Daftar Kampanye
Route::get('/kampanye', [KampanyeSosialController::class, 'index']);

// Route untuk Detail Kampanye
Route::get('/kampanye/{id}', [KampanyeSosialController::class, 'show']);