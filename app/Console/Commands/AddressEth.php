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


        $address = new Address();

// get address
        echo $address->get() . "\n";
// 4e1c45599f667b4dc3604d69e43722d4ace6b770

        echo $address->getPrivateKey() . "\n";
// 33eb576d927573cff6ae50a9e09fc60b672a8dafdfbe3045c7f62955fc55ccb4

        echo $address->getPublicKey() . "\n";
        return Command::SUCCESS;
    }
}
