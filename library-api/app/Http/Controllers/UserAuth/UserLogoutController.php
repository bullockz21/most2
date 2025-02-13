<?php

namespace app\Http\Controllers\UserAuth;

use App\Http\Controllers\Controller;
use App\Presenters\JsonPresenter;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserLogoutController extends Controller
{
    private JsonPresenter $presenter;

    public function __construct(JsonPresenter $presenter)
    {
        $this->presenter = $presenter;
    }

    public function __invoke(Request $request)
    {
        try {
            $token = JWTAuth::getToken();
            JWTAuth::invalidate($token);
            return $this->presenter->present(['message' => 'Вы успешно вышли из системы']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Не удалось выйти'], 500);
        }
    }
}
