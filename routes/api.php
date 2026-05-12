<?php

use App\Http\Controllers\Api\GameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/status', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'API de LUDEXIS funcionando correctamente.',
        'timestamp' => now()
    ]);
});

Route::get('/games', [GameController::class, 'index']);