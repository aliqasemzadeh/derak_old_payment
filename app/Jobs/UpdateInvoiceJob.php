<?php

namespace App\Jobs;

use App\Models\Address;
use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use romanzipp\QueueMonitor\Traits\IsMonitored;

class UpdateInvoiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use IsMonitored;

    public Invoice $invoice;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() : bool
    {
        $address = Address::withExpired()->findOrFail($this->invoice->address_id);
        if($address->balance >= $this->invoiceinvoice->total_in_symbol) {
            $this->invoice->status = 'paid';
            $this->invoice->save();
            return true;
        }

        if($address->balance > 0) {
            $this->invoice->status = 'less_payment';
            $this->invoice->save();
            return true;
        }
    }
}
