<?php

namespace app\Modules\CRUD\Repository;
use App\Models\Book;

class UpdateBookRepository
{
    public function update(int $bookId, array $data): Book
    {
        $book = Book::find($bookId);
        if (!$book) {
            throw new Exception("Книга не найдена");
        }
        $book->update($data);
        return $book;
    }
}
