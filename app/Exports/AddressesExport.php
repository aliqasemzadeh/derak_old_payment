<?php

namespace App\Exports;

use kornrunner\Ethereum\Address;
use Maatwebsite\Excel\Concerns\FromArray;
class AddressesExport implements FromArray
{
    public int $count;
    public function __construct($count = 100)
    {
        $this->count = $count;
    }
    /**
    * @return array
    */
    public function array(): array
    {
        $addresses = [];
        for($i =0; $i <= $this->count; $i++) {
            $address = new Address();
            $addresses[$i]['Address'] = "0x" . $address->get();
            $addresses[$i]['PrivateKey'] = "0x" . $address->getPrivateKey();
            $addresses[$i]['PublicKey'] = "0x" . $address->getPublicKey();
        }
        return $addresses;
    }
}
