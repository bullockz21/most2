<?php

namespace App\Modules\Books\Repository;

use App\Models\Book;
use App\Models\BorrowedBook;
use Carbon\Carbon;

class ReturnBookRepository
{
    public function getActiveBorrow(int $userId, int $bookId): ?BorrowedBook
    {
        return BorrowedBook::where('user_id', $userId)
            ->where('book_id', $bookId)
            ->whereNull('returned_at')
            ->first();
    }

    public function markAsReturned(BorrowedBook $borrowedBook): void
    {
        $borrowedBook->update(['returned_at' => Carbon::now()]);
    }

    public function getBookById(int $bookId): ?Book
    {
        return Book::find($bookId);
    }

    public function incrementAvailableCopies(Book $book): void
    {
        $book->increment('available_copies');
    }
}
