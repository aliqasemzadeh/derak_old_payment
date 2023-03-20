<?php

namespace App\Networks;

use App\Jobs\UpdateInvoiceJob;
use App\Models\Address;
use App\Models\Invoice;

class Ethereum
{
    public static function getInvoiceAddress(Invoice $invoice, $symbol) : Address
    {
        $address = Address::unused()->ofNetwork('ERC20')->latest()->first();
        $address->symbol = $symbol;
        $address->user_id = $invoice->user_id;
        $address->terminal_id = $invoice->terminal_id;
        $address->invoice_id = $invoice->invoice_id;
        $address->status = 'used';
        $address->save();
        return $address;
    }

    public static function updateAddressBalance(Address $address) : Address
    {

        $balance = 0;

        if($balance != 0) {
            if($address->invoice_id) {
                UpdateInvoiceJob::dispatch($address->invoice_id);
            }
        }
        return true;
    }
}
