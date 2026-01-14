<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SiswaController;

Route::middleware('api')->group(function () {
    Route::apiResource('siswa', SiswaController::class);

    Route::get('/test', function () {
        return response()->json([
            'message' => 'API berjalan'
        ]);
    });

});
