<?php

namespace App\Exports;

use kornrunner\Ethereum\Address;
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
        for($i =0; $i < $this->count; $i++) {
            $address = new Address();
            $addresses[$i]['address'] = "0x" . $address->get();
            $addresses[$i]['network'] = $this->network;
            $addresses[$i]['private_key'] = "0x" . $address->getPrivateKey();
            $addresses[$i]['public_key'] = "0x" . $address->getPublicKey();
        }
        \App\Models\Address::insert($addresses);
        return $addresses;
    }
}
