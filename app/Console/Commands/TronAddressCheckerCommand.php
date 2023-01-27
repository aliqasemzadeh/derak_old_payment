<?php

namespace App\Console\Commands;

use App\Jobs\TronBalanceJob;
use App\Jobs\TronTXsJob;
use App\Models\Address;
use Illuminate\Console\Command;

class TronAddressCheckerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tron:address_checker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check tron address checker.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $addresses = Address::where('status', 'check')->get();
        foreach ($addresses as $address) {
            TronBalanceJob::dispatch($address->address, config("symbol.".$address->symbol.".TRC20"));
            TronTXsJob::dispatch($address->address, config("symbol.".$address->symbol.".TRC20"));
        }
        return Command::SUCCESS;
    }
}
