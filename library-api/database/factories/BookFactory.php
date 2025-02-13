<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    // Указываем, что эта фабрика отвечает за модель Book
    protected $model = Book::class;

    public function definition()
    {
        // Генерируем случайное количество копий книги
        $totalCopies = $this->faker->numberBetween(1, 10);

        return [
            'title'            => $this->faker->sentence(3),
            'author'           => $this->faker->name,
            'description'      => $this->faker->paragraph,
            'total_copies'     => $totalCopies,
            'available_copies' => $totalCopies, // По умолчанию все копии доступны
        ];
    }
}
