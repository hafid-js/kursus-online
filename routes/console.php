<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Scheduling\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Artisan::command('activitylog:clean', function () {
    $this->call('activitylog:clean-batch');
})->describe('Clean up old records from the activity log');


// Setup scheduler di sini juga:
app()->booted(function () {
    $schedule = app(Schedule::class);

    $schedule->command('activitylog:clean')->weekly();

    $schedule->call(function () {
        \Log::info('Scheduler test runs at ' . now());
    })->everyMinute();
});

