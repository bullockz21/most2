<?php

namespace App\Modules\Books\UseCase;

use App\Modules\Books\DTO\GetAvailableBooksRequestDTO;
use App\Models\Book;

class GetAvailableBooksUseCase
{
    public function execute(GetAvailableBooksRequestDTO $dto)
    {
        // Возвращаем книги, у которых available_copies > 0
        return Book::where('available_copies', '>', 0)->get();
    }
}
