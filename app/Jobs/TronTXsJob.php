<?php

namespace App\Jobs;

use App\Models\Address;
use App\Models\AddressTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TronTXsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $address;
    public $contract;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($address, $contract)
    {
        $this->address = $address;
        $this->contract = $contract;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $address = $this->address;

        $addressItem = Address::where('address', $address)->first();
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.trongrid.io/v1/accounts/{$address}/transactions/trc20",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response, true);
        foreach ($data['data'] as $row) {
            $transactionId = $row['transaction_id'];
            $tokenInfo = $row['token_info'];
            $from = $row['from'];
            $to = $row['to'];
            $value = $row['value'];

            if($value != 0) {
                $transaction = AddressTransaction::firstOrCreate(
                    [
                        'address_id' => $addressItem->id,
                        'txid' => $transactionId,
                        'to' => $to,
                        'from' => $from,
                    ]
                );
                $transaction->value = $value;
                $transaction->contract = $tokenInfo['address'];
                $transaction->symbol = $tokenInfo['symbol'];
                $transaction->save();
            }
        }
    }
}
