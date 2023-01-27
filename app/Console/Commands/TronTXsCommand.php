<?php

namespace App\Console\Commands;

use App\Models\Address;
use App\Models\AddressTransaction;
use Illuminate\Console\Command;

class TronTXsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tron:txs {address=TAc6YQnPVuvMmiS6DpS6CX6M8zCaLHmpPs}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get last TXs information.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $address = $this->argument('address');

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

        return Command::SUCCESS;
    }
}
