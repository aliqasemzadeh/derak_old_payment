<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use kornrunner\Ethereum\Address;
class AddressEth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'address:eth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        try {
            $tron = new \IEXBase\TronAPI\Tron();

            $generateAddress = $tron->generateAddress(); // or createAddress()
            $isValid = $tron->isAddress($generateAddress->getAddress());


            echo 'Address hex: '. $generateAddress->getAddress(). "\n";
            echo 'Address base58: '. $generateAddress->getAddress(true). "\n";
            echo 'Private key: '. $generateAddress->getPrivateKey(). "\n";
            echo 'Public key: '. $generateAddress->getPublicKey(). "\n";
            echo 'Is Validate: '. $isValid;

            //echo 'Raw data: '.$generateAddress->getRawData();

        } catch (\IEXBase\TronAPI\Exception\TronException $e) {
            echo $e->getMessage();
        }
        return Command::SUCCESS;
    }
}
