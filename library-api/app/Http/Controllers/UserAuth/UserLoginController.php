<?php

namespace App\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Modules\Auth\DTO\UserLoginRequestDTO;
use App\Modules\Auth\UseCase\UserLoginUseCase;
use App\Presenters\JsonPresenter;

class UserLoginController extends Controller
{
    public function __construct(
        private UserLoginUseCase $useCase,
        private JsonPresenter $presenter,
    ) {}

    #[Response(['token' => "JWT_TOKEN"])]
    public function __invoke(LoginRequest $request)
    {
        $dto = new UserLoginRequestDTO(
            $request->email,
            $request->password,
        );

        $response = $this->useCase->execute($dto);
        return $this->presenter->present($response);
    }
}
