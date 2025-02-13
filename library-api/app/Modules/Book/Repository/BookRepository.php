<?php

namespace App\Modules\Books\Repository;

use App\Models\Book;
use App\Modules\Books\DTO\CreateBookRequestDTO;

class BookRepository
{
    public function create(CreateBookRequestDTO $dto): Book
    {
        return Book::create([
            'title'           => $dto->title,
            'author'          => $dto->author,
            'description'     => $dto->description,
            'total_copies'    => $dto->total_copies,
            'available_copies'=> $dto->available_copies,
        ]);
    }

    public function update(Book $book, array $data): Book
    {
        $book->update($data);
        return $book;
    }

    public function delete(Book $book): void
    {
        $book->delete();
    }

    public function getAll()
    {
        return Book::all();
    }
}
