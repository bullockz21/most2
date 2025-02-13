<?php

namespace app\Modules\CRUD\UseCase;

use App\Modules\CRUD\DTO\CreateBookRequestDTO;
use App\Models\Book;

class CreateBookUseCase
{
    public function execute(CreateBookRequestDTO $dto): Book
    {
        return Book::create([
            'title'            => $dto->title,
            'author'           => $dto->author,
            'description'      => $dto->description,
            'total_copies'     => $dto->total_copies,
            'available_copies' => $dto->available_copies,
        ]);
    }
}
