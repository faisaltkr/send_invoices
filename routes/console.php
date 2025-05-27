<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Schedule;


/**
 * 
 * Generate monthly invoice on monthly once 
 */

Schedule::call(function () {
    Artisan::call('app:generate-invoices');
})->monthly();



/**
 * 
 * Handle if any pdf generation faileds 
 */
Schedule::call(function () {
    Artisan::call('app:handle-failed-jobs');
})->monthlyOn('02:00');

/**
 * 
 * only send the pdfs are created that is why scheduled at 4 am monthly once
 */

Schedule::call(function () {
    Artisan::call('app:trigger-invoice-email');
})->monthlyOn('04:00');


//php artisan queue:work --tries=3

/**
 * we can use batch commands for batch wise running, retry for failed jobs
 */
