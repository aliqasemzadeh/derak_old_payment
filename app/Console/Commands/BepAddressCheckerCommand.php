<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class BepAddressCheckerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bep:address_checker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $uri = 'https://bsc-dataseed1.defibit.io/';// Mainnet
        $api = new \Binance\NodeApi($uri);
        $bnb = new \Binance\Bnb($api);

        $config = [
            'contract_address' => '0x55d398326f99059ff775485246999027b3197955',// USDT BEP20
            'decimals' => 18,
        ];
        $bep20 = new \Binance\BEP20($api, $config);


        // *Check balances
        //$address = '0x450c4e9205c2ccd907ff6abddd63699168ff5749';
        //$bnb->bnbBalance($address);
        //echo $bep20->balance($address);


        //$blockID = $bep20->blockNumber();

        $txHash = '0x60c6ff9b16ddf2372cb7f8a1c02c990ae5c93162cf0bc8a866000a122dfba401';
        var_dump($bep20->getTransactionReceipt($txHash));

        //Log::info($bep20->getBlockByNumber(21609237));
    }
}
