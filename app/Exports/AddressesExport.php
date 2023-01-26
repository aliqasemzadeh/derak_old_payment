<?php

namespace App\Exports;

use kornrunner\Ethereum\Address;
use Maatwebsite\Excel\Concerns\FromArray;
class AddressesExport implements FromArray
{
    /**
    * @return array
    */
    public function array(): array
    {
        $addresses = [];
        for($i =0; $i <= 100; $i++) {
            $address = new Address();
            $addresses[$i]['Address'] = "0x" . $address->get();
            $addresses[$i]['PrivateKey'] = "0x" . $address->getPrivateKey();
            $addresses[$i]['PublicKey'] = "0x" . $address->getPublicKey();
        }
        return $addresses;
    }
}
