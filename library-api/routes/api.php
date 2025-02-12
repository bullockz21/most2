<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Auth\UserRegisterController;

Route::prefix('v1')->group(function () {

    // Документация (публично)
    Route::get('/docs', function () {
        return redirect('/docs/index.html');
    });

    /**
     * Маршруты аутентификации пользователей
     */
    Route::prefix('auth')->group(function () {
        Route::post('/register', [UserRegisterController::class, 'register']);
        Route::post('/login', [UserLoginController::class, 'login']);
        Route::post('/logout', [UserLoginController::class, 'logout'])->middleware('jwt.auth');
    });
    });


