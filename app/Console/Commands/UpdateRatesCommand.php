<?php

namespace App\Console\Commands;

use Codenixsv\CoinGeckoApi\CoinGeckoClient;
use Illuminate\Console\Command;

class UpdateRatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update symbol rates.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new CoinGeckoClient();
        $data = $client->simple()->getPrice('bitcoin', 'usd');
        dd($data);
        return Command::SUCCESS;
    }
}
