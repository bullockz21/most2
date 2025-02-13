<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Models\BorrowedBook;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    // Просмотр доступных книг: GET /user/books
    public function index()
    {
        $books = Book::where('available_copies', '>', 0)->get();
        return BookResource::collection($books);
    }

    // Взять книгу: POST /user/books/{book}/borrow
    public function borrow(Request $request, Book $book)
    {
        if ($book->available_copies < 1) {
            return response()->json(['error' => 'Нет доступных копий'], 400);
        }

        BorrowedBook::create([
            'user_id'     => Auth::id(),
            'book_id'     => $book->id,
            'borrowed_at' => Carbon::now(),
        ]);

        $book->decrement('available_copies');

        return response()->json(['message' => 'Книга взята']);
    }

    // Вернуть книгу: POST /user/books/{book}/return
    public function returnBook(Request $request, Book $book)
    {
        $borrowed = BorrowedBook::where('user_id', Auth::id())
            ->where('book_id', $book->id)
            ->whereNull('returned_at')
            ->first();

        if (!$borrowed) {
            return response()->json(['error' => 'Книга не взята или уже возвращена'], 400);
        }

        $borrowed->update(['returned_at' => Carbon::now()]);
        $book->increment('available_copies');

        return response()->json(['message' => 'Книга возвращена']);
    }
}
