<?php

namespace App\Networks;

use App\Jobs\UpdateInvoiceJob;
use App\Models\Address;
use App\Models\Invoice;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

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

    public static function updateAddressBalance(Address $address)
    {
        $balance = 0;
        $client = new Client();
        try {
            $response = $client->get('https://mempool.space/api/address/'.$address->address);
            if($response->getStatusCode() == 200) {
                $bodyData = json_decode($response->getBody()->getContents(),true);
                if($bodyData['chain_stats']['funded_txo_sum'] != 0) {
                    $balance = ($bodyData['chain_stats']['funded_txo_sum'] - $bodyData['chain_stats']['spent_txo_sum']) / 100000000;
                    $address->address->balance = $balance;
                    $address->address->save();
                }

                Log::critical("Balance:" . $bodyData['chain_stats']['funded_txo_sum']);

                if($bodyData['mempool_stats']['funded_txo_sum'] != 0) {
                    $address->status = 'wait';
                    $address->makeEternal();
                    $address->address->save();
                }

            } else {
                Log::critical("Read Address Can Call:" . $response->getStatusCode());
            }
        } catch (\Exception $exception) {
            Log::critical("Read Address Data:" . $exception->getMessage());
        }

        if($balance != 0) {
            if($address->invoice_id) {
                UpdateInvoiceJob::dispatch(Invoice::withExpired()->findOrFail($address->invoice_id));
            }
        }
        return true;
    }
}
