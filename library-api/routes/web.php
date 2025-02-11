<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\UserLoginController;
// Маршруты для пользователей

Route::prefix('v1')->group(function () {

    // Маршрут для документации
    Route::get('/docs', function () {
        return redirect('/docs/index.html');
    })->withoutMiddleware(['auth:sanctum']);

    /**
     * Маршруты для пользователей
     */
    Route::prefix('user')->group(function () {
        // Публичные маршруты: регистрация и авторизация
        Route::post('/register', [UserLoginController::class, 'register'])
            ->withoutMiddleware(['auth:sanctum']);
        Route::post('/login', [UserLoginController::class, 'login'])
            ->withoutMiddleware(['auth:sanctum']);
    });
    });
//
//        // Защищённые маршруты (требуют аутентификации)
//        Route::middleware(['auth:sanctum'])->group(function () {
//            Route::post('/logout', [UserAuthController::class, 'logout']);
//            // Просмотр доступных книг
//            Route::get('/books', [LibraryController::class, 'index']);
//            // Взять книгу
//            Route::post('/books/{book}/borrow', [LibraryController::class, 'borrow']);
//            // Вернуть книгу
//            Route::post('/books/{book}/return', [LibraryController::class, 'return']);
//        });
//    });
//
//    /**
//     * Маршруты для библиотекарей
//     */
//    Route::prefix('librarian')->group(function () {
//        // Публичный маршрут авторизации для библиотекарей
//        Route::post('/login', [LibrarianAuthController::class, 'login'])
//            ->withoutMiddleware(['auth:sanctum']);
//
//        // Защищённые маршруты для библиотекарей
//        Route::middleware(['auth:sanctum'])->group(function () {
//            Route::post('/logout', [LibrarianAuthController::class, 'logout']);
//            // CRUD для книг:
//            // Создание книги
//            Route::post('/books', [BookController::class, 'store']);
//            // Просмотр списка книг
//            Route::get('/books', [BookController::class, 'index']);
//            // Обновление книги
//            Route::put('/books/{book}', [BookController::class, 'update']);
//            // Удаление книги
//            Route::delete('/books/{book}', [BookController::class, 'destroy']);
//        });
//    });
//});
