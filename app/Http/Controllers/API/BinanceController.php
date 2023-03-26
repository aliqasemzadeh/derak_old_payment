<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BinanceController extends Controller
{
    /**
     * @bodyParam address string required
     * @bodyParam symbol string optional
     */

    /**
     * @response 200 integer balance
     */
    public function balanceBEP20($address, $symbol = 'USDT')
    {
        $contract = config("symbol.".$symbol.".BEP20.contract");

        $uri = 'https://bsc-dataseed1.defibit.io/';
        $api = new \Binance\NodeApi($uri);

        $config = [
            'contract_address' => $contract,// USDT BEP20
            'decimals' => 18,
        ];
        $bep20 = new \Binance\BEP20($api, $config);
        return $bep20->balance($address);
    }

    /**
     * @bodyParam address string required
     */

    /**
     * @response 200 integer balance
     */
    public function balanceBNB($address)
    {
        $uri = 'https://bsc-dataseed1.defibit.io/';
        $api = new \Binance\NodeApi($uri);

        $bnb = new \Binance\Bnb($api);

        return $bnb->bnbBalance($address);
    }
}
