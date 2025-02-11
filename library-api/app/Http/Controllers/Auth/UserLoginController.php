<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Modules\Auth\DTO\UserLoginRequestDTO;
use App\Modules\Auth\UseCase\UserLoginUseCase;
use App\Presenter\JsonPresenter;
//use Knuckles\Scribe\Attributes\Group;
//use Knuckles\Scribe\Attributes\Response;

//#[Group("Authentication")]
class UserLoginController extends Controller
{
    public function __construct(
        private UserLoginUseCase $useCase,
        private JsonPresenter $presenter,
    )
    {}

  //  #[Response(['token' => "TOKEN"])]
    public function __invoke(LoginRequest $request)
    {
        // Формируем DTO, используя email и пароль из запроса
        $dto = new UserLoginRequestDTO(
            $request->email,
            $request->password,
        );

        // Выполняем бизнес-логику аутентификации
        $response = $this->useCase->execute($dto);

        // Возвращаем отформатированный JSON-ответ
        return $this->presenter->present($response);
    }
}
