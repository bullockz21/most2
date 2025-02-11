<?php
use Illuminate\Support\Facades\Route;

// Маршруты для пользователей


use App\Http\Controllers\Auth\UserLoginController;

Route::prefix('user')->group(function () {
    // Роут для авторизации пользователей (без middleware, т.к. пользователь ещё не аутентифицирован)
    Route::post('/login', UserLoginController::class);
});

//старый вариант chatgpt
//Route::group(['prefix' => 'user'], function() {
//    Route::post('register', [UserAuthController::class, 'register']);
//    Route::post('login', [UserAuthController::class, 'login']);
//
//    Route::middleware('auth:user')->group(function() {
//        Route::post('logout', [UserAuthController::class, 'logout']);
//        Route::get('books', [LibraryController::class, 'index']);
//        Route::post('books/{book}/borrow', [LibraryController::class, 'borrow']);
//        Route::post('books/{book}/return', [LibraryController::class, 'return']);
//    });
//});
