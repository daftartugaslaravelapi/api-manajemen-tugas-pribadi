<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// ===================================================
// == RUTE PUBLIK (TIDAK PERLU AUTENTIKASI/LOGIN) ==
// ===================================================
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);

    // Rute pencarian daftar tugas
    Route::get('/tasks/search', [TaskController::class, 'search']);

    // Daftarkan semua rute CRUD untuk Task di sini
    Route::apiResource('tasks', TaskController::class);
});
