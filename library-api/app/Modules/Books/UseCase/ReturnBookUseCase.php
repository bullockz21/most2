<?php

namespace App\Modules\Books\UseCase;

use App\Modules\Books\DTO\ReturnBookRequestDTO;
use App\Modules\Books\Repository\ReturnBookRepository;
use Exception;

class ReturnBookUseCase
{
    public function __construct(
        private ReturnBookRepository $repository
    ) {}

    public function execute(ReturnBookRequestDTO $dto): array
    {
        $borrowRecord = $this->repository->getActiveBorrow($dto->userId, $dto->bookId);
        if (!$borrowRecord) {
            throw new Exception("Запись о заимствовании не найдена или книга уже возвращена");
        }

        // Помечаем запись как возвращённую
        $this->repository->markAsReturned($borrowRecord);

        // Получаем книгу
        $book = $this->repository->getBookById($dto->bookId);
        if ($book) {
            // Увеличиваем количество доступных копий
            $this->repository->incrementAvailableCopies($book);
        }

        return ['message' => 'Книга успешно возвращена'];
    }
}
