<?php

namespace App\Console\Commands;

use App\Models\Address;
use App\Models\Invoice;
use Illuminate\Console\Command;

class UpdateInvoiceStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invoice:update_status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $invoices = Invoice::onlyExpired()->where('status', 'address')->get();
        foreach ($invoices as $invoice) {
            $invoice->status = 'expired';
            $invoice->save();
        }
        return Command::SUCCESS;
    }
}
