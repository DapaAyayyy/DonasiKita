<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KampanyeSosialController;


Route::get('/', [KampanyeSosialController::class, 'home']);


Route::get('/kampanye', [KampanyeSosialController::class, 'index']);
Route::get('/kampanye/{id}', [KampanyeSosialController::class, 'show']);