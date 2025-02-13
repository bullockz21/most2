<?php

namespace app\Http\Controllers\LibrarianAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Modules\Auth\DTO\LibrarianLoginRequestDTO;
use App\Modules\Auth\UseCase\LibrarianLoginUseCase;
use App\Presenters\JsonPresenter;

class LibrarianLoginController extends Controller
{
    public function __construct(
        private LibrarianLoginUseCase $useCase,
        private JsonPresenter $presenter,
    ) {}

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
