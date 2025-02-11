<?php
use Illuminate\Support\Facades\Route;

// Маршруты для пользователей


Route::prefix('v1')->middleware(['auth:sanctum'])->group(function () {
    Route::get('/docs', function () {
        return redirect('/docs/index.html');
    })->withoutMiddleware(['auth:sanctum']);

    Route::prefix('auth')->withoutMiddleware(['auth:sanctum'])->group(function () {
        Route::post('/login', LoginController::class);
    });
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
