<?php

namespace app\Modules\CRUD\UseCase;

use App\Modules\CRUD\DTO\UpdateBookRequestDTO;
use App\Modules\CRUD\Repository\UpdateBookRepository;
use App\Models\Book;

class UpdateBookUseCase
{
    public function __construct(
        private UpdateBookRepository $repository
    ) {}

    public function execute(int $bookId, UpdateBookRequestDTO $dto): Book
    {
        // Преобразуем DTO в массив, исключая null значения
        $data = array_filter([
            'title'            => $dto->title,
            'author'           => $dto->author,
            'description'      => $dto->description,
            'total_copies'     => $dto->total_copies,
            'available_copies' => $dto->available_copies,
        ], fn($value) => !is_null($value));

        return $this->repository->update($bookId, $data);
    }
}
