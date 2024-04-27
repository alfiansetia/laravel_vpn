<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('app:monitor-expired-vpn')->dailyAt('13:00')->onSuccess(function () {
            Log::info('Cronjob Monitor VPN berhasil dijalankan');
        })->onFailure(function () {
            Log::error('Cronjob Monitor VPN Gagal dijalankan');
        });

        $schedule->command('database:backup')->dailyAt('01:00')->onSuccess(function () {
            Log::info('Cronjob Backup Database berhasil dijalankan');
        })->onFailure(function () {
            Log::error('Cronjob Backup Database Gagal dijalankan');
        });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
