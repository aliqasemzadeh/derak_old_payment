<?php

namespace App\Networks;

use App\Models\Address;
use App\Models\Invoice;

class Bitcoin
{
    public static function getInvoiceAddress(Invoice $invoice, $symbol) : Address
    {
        $address = Address::unused()->ofNetwork('BTC')->latest()->first();
        $address->symbol = $symbol;
        $address->user_id = $invoice->user_id;
        $address->terminal_id = $invoice->terminal_id;
        $address->invoice_id = $invoice->invoice_id;
        $address->status = 'used';
        return $address;
    }
}
