<?php

namespace App\Console\Commands;

use App\Jobs\GenerateInvoicePdf;
use App\Models\InvoiceLogs;
use Carbon\Carbon;
use Illuminate\Console\Command;

class HandleFailedJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:handle-failed-jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /**
         * fetch only this month data
         */
         $from  = Carbon::now()->startOfMonth()->format('Y-m-d H:i:m');
         $to  = Carbon::now()->endOfMonth()->format('Y-m-d H:i:m');


        $filed_pdfs = InvoiceLogs::where('status', 'failed')->where('attempt_count', '<',3)->whereBetween('generated_at',[$from, $to])->get();

        $splited = $filed_pdfs->chunk(100);
        foreach($splited as $pdf)
        {
            GenerateInvoicePdf::dispatch($pdf->customer, $pdf);
        }
    }
}
