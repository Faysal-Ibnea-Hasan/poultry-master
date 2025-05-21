<?php

use App\Console\Commands\DeactivateExpiredSubscribers;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
Schedule::command('backup:database')->daily(); // here we add our command
Schedule::command(DeactivateExpiredSubscribers::class)
    ->everyMinute();
