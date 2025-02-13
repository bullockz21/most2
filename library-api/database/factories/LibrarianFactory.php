<?php

namespace Database\Factories;

use App\Models\Librarian;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class LibrarianFactory extends Factory
{
    // Указываем, что эта фабрика для модели Librarian
    protected $model = Librarian::class;

    public function definition()
    {
        return [
            'name'     => $this->faker->name,
            'email'    => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // или bcrypt('password')
        ];
    }
}
