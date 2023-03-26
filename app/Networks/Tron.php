<?php

namespace App\Networks;

use App\Jobs\TronBalanceJob;
use App\Jobs\UpdateInvoiceJob;
use App\Models\Address;
use App\Models\Invoice;

class Tron
{
    public static function getInvoiceAddress(Invoice $invoice, $symbol) : Address
    {
        $address = Address::unused()->ofNetwork('TRC20')->latest()->first();
        $address->symbol = $symbol;
        $address->user_id = $invoice->user_id;
        $address->terminal_id = $invoice->terminal_id;
        $address->invoice_id = $invoice->invoice_id;
        $address->status = 'used';
        return $address;
    }

    public static function updateAddressBalance(Address $address) : bool
    {
        TronBalanceJob::dispatch($address->address, $address->symbol);

        if($address->balance != 0) {
            if($address->invoice_id) {
                UpdateInvoiceJob::dispatch(Invoice::withExpired()->findOrFail($address->invoice_id));
            }
            $address->status = 'paid';
            $address->save();
        }

        return true;
    }

    public static function callbackBalance(Invoice $invoice) : bool
    {
        return true;
    }
}
