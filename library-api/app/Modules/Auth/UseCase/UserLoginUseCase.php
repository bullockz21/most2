<?php

namespace App\Modules\Auth\UseCase;

use App\Exceptions\ServiceUnavailableException;
use App\Modules\Auth\DTO\UserLoginRequestDTO;
use App\Modules\Auth\Repository\Exceptions\PasswordDoesntMatchException;
use App\Modules\Auth\Repository\Exceptions\UserNotFoundException;
use App\Modules\Auth\Repository\UserLoginRepository;
use App\Modules\Auth\UseCase\Exceptions\AuthUseCaseException;
use Symfony\Component\HttpFoundation\Response;

class UserLoginUseCase
{
    public function __construct(
        private UserLoginRepository $repository,
    ) {}

    public function execute(UserLoginRequestDTO $dto): array
    {
        try {
            return $this->repository->login($dto);
        } catch (UserNotFoundException $e) {
            throw new AuthUseCaseException('Пользователь с таким email не найден', Response::HTTP_UNPROCESSABLE_ENTITY, $e);
        } catch (PasswordDoesntMatchException $e) {
            throw new AuthUseCaseException('Неправильно введен email или пароль', Response::HTTP_UNPROCESSABLE_ENTITY, $e);
        } catch (\Throwable $e) {
            throw new ServiceUnavailableException($e);
        }
    }
}
