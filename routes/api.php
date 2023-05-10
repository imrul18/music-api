<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {
    Route::post('/login', [AuthController::class, 'adminLogin']);
    Route::middleware(['auth:sanctum', 'admin.type'])->group(function () {
        Route::get('test', function () {
            return "A";
        });
    });
});

Route::prefix('subscriber')->group(function () {
    Route::post('/login', [AuthController::class, 'subscriberLogin']);
    Route::middleware(['auth:sanctum', 'subscriber.type'])->group(function () {
        Route::get('test', function () {
            return "B";
        });
    });
});
