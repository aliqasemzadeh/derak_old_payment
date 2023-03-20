<?php

namespace App\Exports;

use App\Models\Address;
use App\Models\XPub;
use App\Utils\HDUtil;
use Carbon\Carbon;
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
                    $addresses[$i]['created_at'] = Carbon::now();
                    $addresses[$i]['updated_at'] = Carbon::now();
                } catch (\IEXBase\TronAPI\Exception\TronException $e) {
                    Log::error($e->getMessage());
                }
            }
        } else if($this->network == "BEP20" || $this->network == "ERC20") {
            for ($i = 0; $i < $this->count; $i++) {
                $address = new ChainAddress();
                $addresses[$i]['address'] = "0x" . $address->get();
                $addresses[$i]['network'] = $this->network;
                $addresses[$i]['private_key'] = "0x" . $address->getPrivateKey();
                $addresses[$i]['public_key'] = "0x" . $address->getPublicKey();
                $addresses[$i]['created_at'] = Carbon::now();
                $addresses[$i]['updated_at'] = Carbon::now();
            }
        } else if($this->network == "BTC") {
            $xpub = XPub::latest()->first();
            $hd = new HDUtil();
            if($xpub->type == 'zpub') {
                $hd->set_zpub($xpub->xpub);
            }
            if($xpub->type == 'xpub') {
                $hd->set_xpub($xpub->xpub);
            }
            if($xpub->type == 'ypub') {
                $hd->set_ypub($xpub->xpub);
            }


            for ($i = 0; $i < $this->count; $i++) {
                $address = $hd->address_from_master_pub('0/'.$xpub->last);

                $addresses[$i]['address'] = $address;
                $addresses[$i]['network'] = $this->network;
                $addresses[$i]['xpub_id'] = $xpub->id;
                $addresses[$i]['private_key'] = "";
                $addresses[$i]['public_key'] = $xpub->xpub;
                $addresses[$i]['created_at'] = Carbon::now();
                $addresses[$i]['updated_at'] = Carbon::now();


                $xpub->last = $xpub->last + 1;
                $xpub->save();
            }


        }

        Address::insert($addresses);
        return $addresses;
    }
}
