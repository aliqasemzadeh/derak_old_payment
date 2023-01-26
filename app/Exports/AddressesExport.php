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
            $addresses['Address'] = $address->get();
            $addresses['PrivateKey'] = $address->getPrivateKey();
            $addresses['PublicKey'] = $address->getPublicKey();
        }
        return $addresses;
    }
}
