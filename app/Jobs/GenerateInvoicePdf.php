<?php

namespace App\Jobs;

use App\Models\Customer;
use App\Models\InvoiceLogs;
use App\Notifications\Invoice;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;
use Spatie\Browsershot\Browsershot;

class GenerateInvoicePdf implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $tries = 3;

    public function __construct(public  $customers)
    {
       
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach($this->customers as $customer){
            $html = file_get_contents(resource_path('views/invoice.blade.php'));
            $file = $customer->name."_".$customer->email."_invoice_".time().".pdf";
            try {
                Browsershot::html($html)->format('A4')->savePdf("public/invoices/$file");
                InvoiceLogs::create([
                    'customer_id' => $customer->id,
                    'status' => 'success',
                    'pdf_path' => 'public/invoices/'.$file,
                    'attempt_count' => 1,
                    'generated_at' => Carbon::now()->format('Y-m-d H:i:m')
                ]);
            } catch (\Throwable $th) {
                InvoiceLogs::create([
                    'customer_id' => $customer->id,
                    'status' => 'pending',
                    'attempt_count' => 1,
                    'errors' => $th->getMessage(),
                    'generated_at' => Carbon::now()->format('Y-m-d H:i:m')
                ]);
            }
        }

    }
}
