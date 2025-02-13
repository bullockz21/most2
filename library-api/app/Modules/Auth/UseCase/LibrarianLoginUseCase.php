<?php

namespace App\Modules\Auth\UseCase;

use App\Modules\Auth\DTO\LibrarianLoginRequestDTO;
use App\Modules\Auth\Repository\LibrarianLoginRepository;
use App\Modules\Auth\UseCase\Exceptions\AuthUseCaseException;
use Symfony\Component\HttpFoundation\Response;

class LibrarianLoginUseCase
{
    public function __construct(
        private LibrarianLoginRepository $repository,
    ) {}

    public function execute(LibrarianLoginRequestDTO $dto): array
    {
        try {
            return $this->repository->make($dto);
        } catch (\Throwable $e) {
            throw new AuthUseCaseException(
                'Ошибка авторизации: ' . $e->getMessage(),
                Response::HTTP_UNPROCESSABLE_ENTITY,
                $e
            );
        }
    }
}
