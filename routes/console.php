<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// clears tokens every 15 minutes
// can change the time (ex. everyThirtyMinutes(),everyhour()..)
Schedule::command('auth:clear-resets')->everyFifteenMinutes();

