<?php

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\PersonalAccessToken;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('activitylog:clean', function () {
    $this->call('activitylog:clean-batch');
})->describe('Clean up old records from the activity log');

app()->booted(function () {
    $schedule = app(Schedule::class);

    // Clean activity log weekly
    $schedule->command('activitylog:clean')->weekly();

    // Token expiration cleanup daily
    $schedule->call(function () {
        PersonalAccessToken::whereNotNull('expires_at')
            ->where('expires_at', '<', now())
            ->delete();
    })->daily();
});
