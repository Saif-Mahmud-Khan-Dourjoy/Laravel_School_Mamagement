<?php

namespace App\Console;

use App\Console\Commands\SendBirthDayWish;
use App\Console\Commands\SendDailyCollection;
use App\Console\Commands\SendOccasionGreeting;
use App\Console\Commands\SendMonthlyEmail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        SendDailyCollection::class,
        SendBirthDayWish::class,
        SendOccasionGreeting::class,
        SendMonthlyEmail::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('daily:collection')->dailyAt('20:00');
        $schedule->command('send:birthday')->dailyAt('07:00');
        $schedule->command('send:occasionalGreeting')->everyMinute();
        $schedule->command('send:monthlySmsReport')->monthlyOnLastDay('20:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
