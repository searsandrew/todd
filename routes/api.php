<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/mobile/login', [AuthController::class, 'mobileLogin']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/mobile/logout', [AuthController::class, 'mobileLogout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});


