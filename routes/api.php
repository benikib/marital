<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PersonneController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/personnes', [PersonneController::class, 'index']);
    Route::post('/personnes', [PersonneController::class, 'store']);
    Route::get('/personnes/{id}', [PersonneController::class, 'show']);
    Route::put('/personnes/{id}', [PersonneController::class, 'update']);
    Route::delete('/personnes/{id}', [PersonneController::class, 'destroy']);
});