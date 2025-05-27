<?php

namespace App\Console\Commands;

use App\Jobs\SendInvoiceEmail;
use App\Models\InvoiceLogs;
use Carbon\Carbon;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Throwable;

class TriggerInvoiceEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:trigger-invoice-email';

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
        $from = Carbon::now()->startOfMonth()->format('Y-m-d H:i:m');
        $to = Carbon::now()->endOfMonth()->format('Y-m-d H:i:m');
        $invoices = InvoiceLogs::where('status', 'success')->whereBetween('generated_at', [$from,$to])->get();

        $batches = $invoices->chunk(1000);

        foreach($batches as $invoiceBatch)
        {
            $newBatches[] = new SendInvoiceEmail($invoiceBatch);
        }

        
           
        $batch = Bus::batch($newBatches)->before(function (Batch $batch) {
            // The batch has been created but no jobs have been added...
        })->progress(function (Batch $batch) {
            // A single job has completed successfully...
        })->then(function (Batch $batch) {
            // All jobs completed successfully...
        })->catch(function (Batch $batch, Throwable $e) {
            // First batch job failure detected...
        })->finally(function (Batch $batch) {
            // The batch has finished executing...
        })->dispatch();
            
        return $batch->id;
    }
}
