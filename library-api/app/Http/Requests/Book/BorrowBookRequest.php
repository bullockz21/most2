<?php

namespace App\Http\Requests\Book;

use Illuminate\Foundation\Http\FormRequest;

class BorrowBookRequest extends FormRequest
{
    public function authorize(): bool {
        // Здесь можно добавить проверку аутентификации, но, как правило, уже в middleware JWT
        return true;
    }

    public function rules(): array {
        return [
            // Если идентификатор книги передается в параметрах URL, правила для тела запроса могут быть пустыми.
        ];
    }
}
