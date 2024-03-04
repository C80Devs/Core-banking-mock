<?php

namespace App\Console;

use App\Http\Controllers\LAController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use ProcessIncomingEmails;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        ProcessIncomingEmails::class,
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
      $schedule->call(function () {
            LAController::updateFromERP();
       })->everyTwoMinutes();


        $schedule->command('emails:process')->everyThreeMinutes() ;
        //change back to 5 minutes

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
