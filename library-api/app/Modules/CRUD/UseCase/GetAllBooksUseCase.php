<?php

namespace app\Modules\CRUD\UseCase;

use App\Modules\CRUD\DTO\GetAllBooksRequestDTO;
use App\Modules\CRUD\Repository\GetAllBooksRepository;
use Illuminate\Database\Eloquent\Collection;
class GetAllBooksUseCase
{
    public function __construct(
        private GetAllBooksRepository $repository
    ) {}

    /**
     * Выполняет бизнес-логику получения всех книг.
     *
     * @param GetAllBooksRequestDTO $dto
     * @return Collection
     */
    public function execute(GetAllBooksRequestDTO $dto): Collection
    {
        return $this->repository->getAll();
    }
}
