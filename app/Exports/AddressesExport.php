<?php

namespace App\Exports;

use App\Models\Address;
use Illuminate\Support\Facades\Log;
use kornrunner\Ethereum\Address as ChainAddress;
use Maatwebsite\Excel\Concerns\FromArray;

class AddressesExport implements FromArray
{
    public int $count;
    public string $network;

    public function __construct($count = 100, $network = "BEP20")
    {
        $this->count = $count;
        $this->network = $network;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        $addresses = [];
        if ($this->network == "TRC20") {
            for ($i = 0; $i < $this->count; $i++) {
                try {
                    $tron = new \IEXBase\TronAPI\Tron();
                    $generateAddress = $tron->generateAddress(); // or createAddress()
                    $addresses[$i]['address'] = $generateAddress->getAddress(true);
                    $addresses[$i]['network'] = $this->network;
                    $addresses[$i]['private_key'] = $generateAddress->getPrivateKey();
                    $addresses[$i]['public_key'] = $generateAddress->getPublicKey();
                } catch (\IEXBase\TronAPI\Exception\TronException $e) {
                    Log::error($e->getMessage());
                }
            }
        } else {
            for ($i = 0; $i < $this->count; $i++) {
                $address = new ChainAddress();
                $addresses[$i]['address'] = "0x" . $address->get();
                $addresses[$i]['network'] = $this->network;
                $addresses[$i]['private_key'] = "0x" . $address->getPrivateKey();
                $addresses[$i]['public_key'] = "0x" . $address->getPublicKey();
            }
        }

        Address::insert($addresses);
        return $addresses;
    }
}
