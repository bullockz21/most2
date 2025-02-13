<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run()
    {
        // Создаем 50 книг с использованием фабрики
        Book::factory()->count(50)->create();
    }
}
