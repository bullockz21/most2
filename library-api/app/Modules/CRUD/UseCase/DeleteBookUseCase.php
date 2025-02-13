<?php

namespace app\Modules\CRUD\UseCase;

use App\Modules\CRUD\DTO\DeleteBookRequestDTO;
use App\Modules\CRUD\Repository\DeleteBookRepository;

class DeleteBookUseCase
{
    public function __construct(
        private DeleteBookRepository $repository
    ) {}

    /**
     * Выполняет бизнес-логику удаления книги.
     *
     * @param DeleteBookRequestDTO $dto
     * @return array
     */
    public function execute(DeleteBookRequestDTO $dto): array
    {
        $this->repository->delete($dto->bookId);
        return ['message' => 'Книга успешно удалена'];
    }
}
