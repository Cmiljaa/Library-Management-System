<?php

use App\Console\Commands\CheckBookLoan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('check:book_loan')->dailyAt('08:00')->timezone('Europe/Belgrade');