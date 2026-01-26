<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SiswaController;

Route::get('/test', function () {
    return response()->json(['status' => 'API OK']);
});

Route::get('/siswa', [SiswaController::class, 'index']);
Route::post('/siswa', [SiswaController::class, 'store']);
