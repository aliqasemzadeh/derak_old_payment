<?php

namespace App\Jobs\Bnb;

use App\Models\Address;
use App\Models\AddressTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TransferToMainWalletJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $address;
    public $contact;

    /**
     * Create a new job instance.
     */
    public function __construct($address, $contract = null)
    {
        $this->address = $address;
        $this->contract = $contract;;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->contact) {
            $response = Http::get(env('APP_BSCSCAN_API', 'https://api.bscscan.com/api'), [
                'module' => 'account',
                'action' => 'tokentx',
                'address' => $this->address,
                'startblock' => '0',
                'endblock' => '999999999',
                'page' => '1',
                'offset' => '100',
                'sort' => 'desc',
                'apikey' => env('APP_BSCSCAN_KEY'),
            ]);

            $data = $response->json();


            if($response->successful() && isset($data['status']) && $data['status'] == 1) {

                foreach ($data['result'] as $transaction) {

                    if(!$transaction['hash']) continue;

                    $address = Address::where('address', $this->address)->first();

                    $addressTransaction = AddressTransaction::firstOrCreate([
                        'address_id' => $address->id,
                        'contract' => '',
                        'txid' => '',
                        'from' => '',
                        'to' => ''
                    ]);


                }

            }

            if(!$response->successful()) {
                Log::error('Bscscan Exception:');
                Log::error($response->body());
            }

            usleep(500000);


        } else {

        }
    }
}
