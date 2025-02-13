<?php

namespace app\Modules\CRUD\Repository;

use App\Models\Book;
use Exception;

class DeleteBookRepository
{
    public function delete(int $bookId): void
    {
        $book = Book::find($bookId);
        if (!$book) {
            throw new Exception("Книга с ID {$bookId} не найдена");
        }
        $book->delete();
    }
}
