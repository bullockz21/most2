<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserAuth\UserRegisterController as PostUSerRegisterController;
use App\Http\Controllers\UserAuth\UserLoginController as PostUserLoginController;
use App\Http\Controllers\UserAuth\UserLogoutController as PostUserLogoutController;

//use App\Http\Controllers\BookController;
use App\Http\Controllers\Book\LibraryController;
use App\Http\Controllers\Book\LibraryBorrowController;
use App\Http\Controllers\Book\LibraryReturnController;

//crud
use App\Http\Controllers\CRUD\BookController;
use App\Http\Controllers\CRUD\UpdateBookController;
use App\Http\Controllers\CRUD\LibraryAllBooksController;
use App\Http\Controllers\CRUD\DeleteBookController;


use App\Http\Controllers\LibrarianAuth\LibrarianLoginController as PostLibrarianLoginController; ;
use App\Http\Controllers\LibrarianAuth\LibrarianLogoutController as PostLibrarianLogoutController;

Route::prefix('v1')->group(function () {

    Route::get('/docs', function () {
        return redirect('/docs/index.html');
    })->withoutMiddleware(['jwt.auth']);


    Route::prefix('auth')->group(function () {
        Route::post('/register', PostUserRegisterController::class);
        Route::post('/login', PostUserLoginController::class);
        Route::post('/logout', PostUserLogoutController::class);
    });

    Route::prefix('librarian/auth')->group(function () {
        Route::post('/login', PostLibrarianLoginController::class);
        Route::post('/logout', PostLibrarianLogoutController::class);

    });

    Route::middleware('jwt.auth')->prefix('user')->group(function () {
        // GET /api/v1/user/books – просмотр доступных книг
        Route::get('/books', LibraryController::class);
        Route::post('/books/{book}/borrow', LibraryBorrowController::class);
        Route::post('/books/{book}/return', LibraryReturnController::class);

    });


    Route::middleware('jwt.auth')->prefix('librarian')->group(function () {
        // POST /api/v1/librarian/books – создание книги
        Route::post('/books', BookController::class);//создание книги
        Route::put('/books/{book}', UpdateBookController::class);//обновление книги
        Route::get('/books', LibraryAllBooksController::class);
        Route::delete('/books/{book}', DeleteBookController::class);

    });
//    Route::middleware('jwt.auth')->group(function () {
//
//        // Маршруты для пользователей: просмотр книг, брать и сдавать книги
//        Route::prefix('user')->group(function () {
//            Route::get('/books', [LibraryController::class, 'index']);
//            Route::post('/books/{book}/borrow', [LibraryController::class, 'borrow']);
//            Route::post('/books/{book}/return', [LibraryController::class, 'returnBook']);
//        });
//
//        // Маршруты для библиотекарей: CRUD операций с книгами
//        Route::prefix('librarian')->group(function () {
//            Route::post('/books', [BookController::class, 'store']);
//            Route::get('/books', [BookController::class, 'index']);
//            Route::put('/books/{book}', [BookController::class, 'update']);
//            Route::delete('/books/{book}', [BookController::class, 'destroy']);
//        });
//
//        // Можно добавить маршрут выхода (logout) здесь, если нужно
//    });
});
//{
//    "email": "user@example.com",
//  "password": "ваш_пароль"
//}
//{
//    "name": "Иван Иванов",
//  "email": "ivan@example.com",
//  "password": "yourpassword",
//  "password_confirmation": "yourpassword"
//}

