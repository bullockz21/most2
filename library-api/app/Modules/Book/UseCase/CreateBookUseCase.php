<?php

namespace App\Modules\Books\UseCase;

use App\Modules\Books\DTO\CreateBookRequestDTO;
use App\Modules\Books\Repository\BookRepository;

class CreateBookUseCase
{
    public function __construct(
        private BookRepository $repository
    ) {}

    public function execute(CreateBookRequestDTO $dto)
    {
        return $this->repository->create($dto);
    }
}
