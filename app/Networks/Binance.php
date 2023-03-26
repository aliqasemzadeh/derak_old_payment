<?php

namespace App\Networks;

use App\Jobs\UpdateInvoiceJob;
use App\Models\Address;
use App\Models\Invoice;

class Binance
{
    public static function getInvoiceAddress(Invoice $invoice, $symbol) : Address
    {
        $address = Address::unused()->ofNetwork('BEP20')->latest()->first();
        $address->symbol = $symbol;
        $address->user_id = $invoice->user_id;
        $address->terminal_id = $invoice->terminal_id;
        $address->invoice_id = $invoice->invoice_id;
        $address->status = 'used';
        return $address;
    }

    public static function updateAddressBalance(Address $address) : bool
    {

        $balance = 0;

        if($balance != 0) {
            if($address->invoice_id) {
                UpdateInvoiceJob::dispatch(Invoice::withExpired()->findOrFail($address->invoice_id));
            }
        }
        return true;
    }
}
