<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Schedule;


/**
 * 
 * Generate monthly invoice on monthly once 
 */

 Schedule::command('app:generate-invoices')->monthly(31, '12:00');

/**
 * 
 * Handle if any pdf generation faileds 
 */

Schedule::command('app:handle-failed-jobs')->monthlyOn(31, '02:00');

/**
 * 
 * only send the pdfs are created that is why scheduled at 4 am monthly once
 */

Schedule::command('app:trigger-invoice-email')->monthlyOn(31, '04:00');

//php artisan queue:work --tries=3

/**
 * we can use batch commands for batch wise running, retry for failed jobs
 */
