<?php

namespace App\Jobs;

use App\Models\EmailLog;
use App\Models\InvoiceLogs;
use App\Notifications\Invoice;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendInvoiceEmail implements ShouldQueue
{
    use Batchable, Queueable,InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     */

     public $tries=3;


    public function __construct(public $invoices)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach($this->invoices as $invoice)
        {
            try {
                $customer = $invoice->customer;
                $customer->notify(new Invoice($invoice));
                EmailLog::create([
                    'customer_id' => $customer->id,
                    'status' => 'success',
                    'pdf_path' => $invoice->pdf_path,
                    'attempt_count' => 1,
                    'sent_at' => Carbon::now()->format('Y-m-d H:i:m')
                ]);
            
                } catch (\Throwable $th) {
                EmailLog::create([
                    'customer_id' => $customer->id,
                    'status' => 'failed',
                    'errors' => $th->getMessage(),
                    'attempt_count' => 1,
                    'sent_at' => Carbon::now()->format('Y-m-d H:i:m')
                ]);
            }
        }
        
        
    }
}
