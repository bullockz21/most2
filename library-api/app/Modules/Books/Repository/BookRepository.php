<?php

namespace App\Modules\Books\Repository;

use App\Models\Book;

class BookRepository
{
    public function getBookById(int $bookId): ?Book
    {
        return Book::find($bookId);
    }

    public function decrementAvailableCopies(Book $book): void
    {
        $book->decrement('available_copies');
    }
}
