<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\BookController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/test', function () {
    return response()->json(['ok' => true]);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// Route buku biasanya diletakkan di public jika pengunjung bisa melihat daftar buku
Route::apiResource('books', BookController::class);

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (Harus Login)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY (Middleware khusus admin)
    |--------------------------------------------------------------------------
    */
    Route::middleware('admin')->group(function () {
        // Statistik & Chart
        Route::get('/admin/chart', [AdminController::class, 'chart']);
        Route::get('/admin/stats', [AdminController::class, 'stats']);

        // Manajemen Transaksi
        Route::get('/admin/transaksi', [AdminController::class, 'getTransaksi']);
        Route::post('/admin/transaksi', [AdminController::class, 'storeTransaksi']);
        Route::put('/admin/transaksi/{id}/selesai', [AdminController::class, 'selesaiTransaksi']);
    });
});
