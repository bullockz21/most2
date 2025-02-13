<?php

namespace app\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Modules\Auth\DTO\UserRegisterRequestDTO;
use App\Modules\Auth\UseCase\UserRegisterUseCase;
use App\Presenters\JsonPresenter;

class UserRegisterController extends Controller
{
    public function __construct(
        private UserRegisterUseCase $useCase,
        private JsonPresenter $presenter,
    ) {}

    public function __invoke(RegisterRequest $request)
    {
        $dto = new UserRegisterRequestDTO(
            $request->name,
            $request->email,
            $request->password,
            $request->password_confirmation,
        );
        $response = $this->useCase->execute($dto);
        return $this->presenter->present($response);
    }
}
