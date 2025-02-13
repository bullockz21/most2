<?php

namespace app\Modules\CRUD\Repository;
use App\Models\Book;

class UpdateBookRepository
{
    /**
     * Обновляет книгу с заданными данными.
     *
     * @param int $bookId
     * @param array $data
     * @return Book
     * @throws Exception если книга не найдена.
     */
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
