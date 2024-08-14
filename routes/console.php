<?php

use App\Jobs\UpdateDailyTasks;
use App\Jobs\Remind;
//use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::job(app(UpdateDailyTasks::class))->hourly();
Schedule::job(app(Remind::class))->everyThirtySeconds();
//Schedule::job(app(\App\Jobs\Troll::class))->everyTenSeconds();
