<?php
// app/Modules/Auth/UseCase/UserRegisterUseCase.php
namespace App\Modules\Auth\UseCase;

use App\Exceptions\ServiceUnavailableException;
use App\Modules\Auth\DTO\UserRegisterRequestDTO;
use App\Modules\Auth\Repository\UserRegisterRepository;
use App\Modules\Auth\UseCase\Exceptions\AuthUseCaseException;
use Symfony\Component\HttpFoundation\Response;

class UserRegisterUseCase
{
    public function __construct(
        private UserRegisterRepository $repository,
    ) {}

    public function execute(UserRegisterRequestDTO $dto): array
    {
        try {
            return $this->repository->register($dto);
        } catch (\Throwable $e) {
            throw new AuthUseCaseException('Ошибка регистрации', Response::HTTP_UNPROCESSABLE_ENTITY, $e);
        }
    }
}
