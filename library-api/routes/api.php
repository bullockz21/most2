<?php

use App\Http\Controllers\Auth\UserLogoutController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\Auth\UserRegisterController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\Auth\LibrarianLoginController;
use App\Http\Controllers\Auth\LibrarianLogoutController;

Route::prefix('v1')->group(function () {

    // Маршрут для документации (публичный)
    Route::get('/docs', function () {
        return redirect('/docs/index.html');
    })->withoutMiddleware(['jwt.auth']);

    /**
     * Публичные маршруты аутентификации для пользователей
     */
    Route::prefix('auth')->group(function () {
        Route::post('/register', UserRegisterController::class);
        Route::post('/login', UserLoginController::class);
        Route::post('/logout', UserLogoutController::class);
    });

    /**
     * Публичные маршруты аутентификации для библиотекарей
     */
    Route::prefix('librarian/auth')->group(function () {
        Route::post('/login', LibrarianLoginController::class);
        Route::post('/logout', LibrarianLogoutController::class);

    });

    /**
     * Защищённые маршруты – требуют валидного JWT
     */
    Route::middleware('jwt.auth')->group(function () {

        // Маршруты для пользователей: просмотр книг, брать и сдавать книги
        Route::prefix('user')->group(function () {
            Route::get('/books', [LibraryController::class, 'index']);
            Route::post('/books/{book}/borrow', [LibraryController::class, 'borrow']);
            Route::post('/books/{book}/return', [LibraryController::class, 'returnBook']);
        });

        // Маршруты для библиотекарей: CRUD операций с книгами
        Route::prefix('librarian')->group(function () {
            Route::post('/books', [BookController::class, 'store']);
            Route::get('/books', [BookController::class, 'index']);
            Route::put('/books/{book}', [BookController::class, 'update']);
            Route::delete('/books/{book}', [BookController::class, 'destroy']);
        });

        // Можно добавить маршрут выхода (logout) здесь, если нужно
    });
});
