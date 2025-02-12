<?php
// app/Http/Controllers/Auth/UserRegisterController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Modules\Auth\DTO\UserRegisterRequestDTO;
use App\Modules\Auth\UseCase\UserRegisterUseCase;
use App\Presenters\JsonPresenter;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\Response;

#[Group("Authentication")]
class UserRegisterController extends Controller
{
    public function __construct(
        private UserRegisterUseCase $useCase,
        private JsonPresenter $presenter,
    ) {}

    #[Response(['user' => "User Data", 'token' => "JWT_TOKEN"])]
    public function register(RegisterRequest $request)
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
