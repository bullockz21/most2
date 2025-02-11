<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|string',
            'password' => 'required|string|min:8',
        ];
    }

//    public function bodyParameters(): array
//    {
//        return [
//            'email' => [
//                'description' => 'Логин пользователя системы.',
//            ],
//            'password' => [
//                'description' => 'Пароль пользователя.',
//            ],
//        ];
//    }
}
