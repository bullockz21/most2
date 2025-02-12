<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\CreateLibrarian;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        CreateLibrarian::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Здесь можно определить задачи, например:
        // $schedule->command('inspire')->hourly();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
