<?php

namespace App\Console\Commands;

use App\Jobs\GenerateInvoicePdf;
use Illuminate\Console\Command;
use App\Models\Customer;
use Spatie\Browsershot\Browsershot;

class GenerateInvoices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-invoices';

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
        
        $customers = Customer::where('active',true)->get();
        $brakedArray = $customers->chunk(1000);
        foreach($brakedArray as $customer)
        {
            GenerateInvoicePdf::dispatch($customers);
        }
    }
}
