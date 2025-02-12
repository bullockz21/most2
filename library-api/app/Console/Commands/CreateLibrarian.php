<?php

namespace App\Console\Commands;

use App\Models\Librarian;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateLibrarian extends Command
{
    protected $signature = 'create:librarian {name} {email} {password}';

    protected $description = 'Создание нового библиотекаря через консоль';

    public function handle(): int
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');

        $librarian = Librarian::create([
            'name'     => $name,
            'email'    => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("Библиотекарь успешно создан: ID {$librarian->id}");

        return 0;
    }
}
