<?php

namespace app\Modules\CRUD\Repository;

use App\Models\Book;
class CreateBookRepository
{
    public function create(array $data): Book
    {
        return Book::create($data);
    }
}
