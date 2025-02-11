<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * Имя и сигнатура команды в консоли.
     */
    protected $signature = 'create:user {name} {email} {password}';

    /**
     * Описание команды.
     */
    protected $description = 'Регистрация нового пользователя через консоль';

    /**
     * Выполнение команды.
     */
    public function handle()
    {
        $name     = $this->argument('name');
        $email    = $this->argument('email');
        $password = $this->argument('password');

        // Создаем пользователя с хешированием пароля
        $user = User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("Пользователь создан: ID {$user->id}");
    }
}

