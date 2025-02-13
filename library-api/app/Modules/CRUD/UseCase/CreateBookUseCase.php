<?php

namespace app\Modules\CRUD\UseCase;

use App\Modules\CRUD\DTO\CreateBookRequestDTO;
use App\Models\Book;
use App\Modules\CRUD\Repository\CreateBookRepository;

class CreateBookUseCase
{
    public function __construct(
        private CreateBookRepository $repository
    ) {}

    public function execute(CreateBookRequestDTO $dto): Book
    {

        $data = [
            'title'            => $dto->title,
            'author'           => $dto->author,
            'description'      => $dto->description,
            'total_copies'     => $dto->total_copies,
            'available_copies' => $dto->available_copies,
        ];

        return $this->repository->create($data);
    }
}
