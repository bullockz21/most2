<?php

namespace app\Http\Requests\CRUD;

use Illuminate\Foundation\Http\FormRequest;
class DeleteBookRequest extends FormRequest
{
    public function authorize(): bool
{
    // Дополнительная авторизация через middleware (например, JWT) уже проверяет права доступа
    return true;
}

    public function rules(): array
    {
        // В данном случае данные приходят через URL, поэтому дополнительных правил не требуется
        return [];
    }
}
