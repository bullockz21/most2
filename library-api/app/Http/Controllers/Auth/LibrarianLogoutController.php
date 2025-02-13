<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Presenters\JsonPresenter;

class LibrarianLogoutController extends Controller
{
    private JsonPresenter $presenter;

    public function __construct(JsonPresenter $presenter)
    {
        $this->presenter = $presenter;
    }

    /**
     * Метод __invoke будет вызываться, когда пользователь делает запрос на выход.
     */
    public function __invoke(Request $request)
    {
        try {
            // Получаем текущий JWT-токен из запроса
            $token = JWTAuth::getToken();
            // Инвалидируем токен, делая его недействительным
            JWTAuth::invalidate($token);

            return $this->presenter->present(['message' => 'Вы успешно вышли из системы']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось выйти'], 500);
        }
    }
}
