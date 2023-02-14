<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EthereumController extends Controller
{
    public function balanceERC20($address, $symbol = 'USDT')
    {
        $contract = config("symbol.".$symbol.".ERC20");
    }

    public function balanceETH($address)
    {

    }
}
