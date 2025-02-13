<?php

namespace app\Http\Requests\CRUD;

use Illuminate\Foundation\Http\FormRequest;
class DeleteBookRequest extends FormRequest
{
    public function authorize(): bool
{
    return true;
}

    public function rules(): array
    {
        return [];
    }
}
