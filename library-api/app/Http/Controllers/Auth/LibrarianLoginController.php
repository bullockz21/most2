<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest; // Можно использовать общий LoginRequest, если структура одинакова
use App\Modules\Auth\DTO\LibrarianLoginRequestDTO;
use App\Modules\Auth\UseCase\LibrarianLoginUseCase;
use App\Presenters\JsonPresenter;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Response;

#[Group("Authentication")]
class LibrarianLoginController extends Controller
{
    public function __construct(
        private LibrarianLoginUseCase $useCase,
        private JsonPresenter $presenter,
    ) {}

    #[Response(['token' => "JWT_TOKEN"])]
    public function __invoke(LoginRequest $request)
    {
        $dto = new LibrarianLoginRequestDTO(
            $request->email,
            $request->password,
        );

        $response = $this->useCase->execute($dto);

        return $this->presenter->present($response);
    }
}
