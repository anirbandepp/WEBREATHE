<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote');

// Schedule::command('test:cron')->everyFiveSeconds();

Schedule::command('module:generate-status')->everyFiveSeconds();

Schedule::command('module:generate-data')->everyTenMinutes();

// php artisan schedule:run
// php artisan schedule:list
// php artisan schedule:work
