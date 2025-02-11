<?php
use Illuminate\Support\Facades\Route;

// Маршруты для пользователей
Route::group(['prefix' => 'user'], function() {
//    Route::post('register', [UserAuthController::class, 'register']);
//    Route::post('login', [UserAuthController::class, 'login']);
//
//    Route::middleware('auth:user')->group(function() {
//        Route::post('logout', [UserAuthController::class, 'logout']);
//        Route::get('books', [LibraryController::class, 'index']);
//        Route::post('books/{book}/borrow', [LibraryController::class, 'borrow']);
//        Route::post('books/{book}/return', [LibraryController::class, 'return']);
//    });
});


// Маршруты для библиотекарей
Route::group(['prefix' => 'librarian'], function() {
//    Route::post('login', [LibrarianAuthController::class, 'login']);
//    Route::middleware('auth:librarian')->group(function() {
//        Route::post('logout', [LibrarianAuthController::class, 'logout']);
//        Route::get('books', [BookController::class, 'index']);
//        Route::post('books', [BookController::class, 'store']);
//        Route::put('books/{book}', [BookController::class, 'update']);
//        Route::delete('books/{book}', [BookController::class, 'destroy']);
//    });
});
