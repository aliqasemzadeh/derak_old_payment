<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Utils\TronUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BinanceController extends Controller
{
    public function balanceBEP20($address, $symbol = 'USDT')
    {
        $contract = config("symbol.".$symbol.".TRC20");
        $fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
        $solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
        $eventServer = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');

        try {
            $tron = new \IEXBase\TronAPI\Tron($fullNode, $solidityNode, $eventServer);
        } catch (\IEXBase\TronAPI\Exception\TronException $e) {
            Log::error($e->getMessage());
        }

        $abi = '[{"constant":true,"inputs":[],"name":"name","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"value","type":"uint256"}],"name":"approve","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"totalSupply","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"sender","type":"address"},{"name":"recipient","type":"address"},{"name":"amount","type":"uint256"}],"name":"transferFrom","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[],"name":"decimals","outputs":[{"name":"","type":"uint8"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"addedValue","type":"uint256"}],"name":"increaseAllowance","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"account","type":"address"}],"name":"balanceOf","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":true,"inputs":[],"name":"symbol","outputs":[{"name":"","type":"string"}],"payable":false,"stateMutability":"view","type":"function"},{"constant":false,"inputs":[{"name":"spender","type":"address"},{"name":"subtractedValue","type":"uint256"}],"name":"decreaseAllowance","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":false,"inputs":[{"name":"recipient","type":"address"},{"name":"amount","type":"uint256"}],"name":"transfer","outputs":[{"name":"","type":"bool"}],"payable":false,"stateMutability":"nonpayable","type":"function"},{"constant":true,"inputs":[{"name":"owner","type":"address"},{"name":"spender","type":"address"}],"name":"allowance","outputs":[{"name":"","type":"uint256"}],"payable":false,"stateMutability":"view","type":"function"},{"inputs":[],"payable":false,"stateMutability":"nonpayable","type":"constructor"},{"anonymous":false,"inputs":[{"indexed":true,"name":"from","type":"address"},{"indexed":true,"name":"to","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Transfer","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"name":"owner","type":"address"},{"indexed":true,"name":"spender","type":"address"},{"indexed":false,"name":"value","type":"uint256"}],"name":"Approval","type":"event"}]';
        $abiAry = json_decode($abi, true);

        $function = "symbol";
        $params = [];
        $result = $tron->getTransactionBuilder()->triggerConstantContract($abiAry, TronUtil::base58check2HexString($contract),$function, $params, TronUtil::base58check2HexString($address));
        $symbol = $result[0];
        //get decimals
        $function = "decimals";
        $params = [];
        $result = $tron->getTransactionBuilder()->triggerConstantContract($abiAry, TronUtil::base58check2HexString($contract),$function, $params, TronUtil::base58check2HexString($address));
        $decimals = $result[0]->toString();

        if (!is_numeric($decimals)) {
            throw new Exception("Token decimals not found");
        }

        //get balance
        $function = "balanceOf";
        $params = [ str_pad(TronUtil::base58check2HexString($address),64,"0", STR_PAD_LEFT) ];
        $result = $tron->getTransactionBuilder()->triggerConstantContract($abiAry, TronUtil::base58check2HexString($contract),$function, $params, TronUtil::base58check2HexString($address));
        $balance = $result[0]->toString();
        if (!is_numeric($balance)) {
            throw new Exception("Token balance not found");
        }
        return $balance;
    }

    public function balanceBNB($address)
    {
        $fullNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
        $solidityNode = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');
        $eventServer = new \IEXBase\TronAPI\Provider\HttpProvider('https://api.trongrid.io');

        try {
            $tron = new \IEXBase\TronAPI\Tron($fullNode, $solidityNode, $eventServer);
        } catch (\IEXBase\TronAPI\Exception\TronException $e) {
            Log::error($e->getMessage());
        }

        return $tron->getBalance($address, true);
    }
}
