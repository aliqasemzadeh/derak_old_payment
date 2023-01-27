<?php

namespace App\Console\Commands;

use App\Models\Rate;
use App\Models\Symbol;
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
        foreach (Symbol::all() as $symbol) {
            $client = new CoinGeckoClient();
            $priceInfo = $client->simple()->getPrice($symbol->coingecko_id, 'usd');
            $rate = new Rate();
            $rate->symbol = $symbol->symbol;
            $rate->price = $priceInfo[$symbol->coingecko_id]['usd'];
            $rate->save();
        }
        return Command::SUCCESS;
    }
}
