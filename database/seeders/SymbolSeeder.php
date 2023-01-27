<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SymbolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $symbol = new Symbol();
        $symbol->title = 'Bitcoin';
        $symbol->symbol = 'BTC';
        $symbol->coingecko_id = 'bitcoin';
        $symbol->sort_order = 1;
        $symbol->save();

        $symbol = new Symbol();
        $symbol->title = 'Tether';
        $symbol->symbol = 'USDT';
        $symbol->coingecko_id = 'tether';
        $symbol->sort_order = 2;
        $symbol->save();

        $symbol = new Symbol();
        $symbol->title = 'USD Coin';
        $symbol->symbol = 'USDC';
        $symbol->coingecko_id = 'usd-coin';
        $symbol->sort_order = 3;
        $symbol->save();

        $symbol = new Symbol();
        $symbol->title = 'Binance USD';
        $symbol->symbol = 'BUSD';
        $symbol->coingecko_id = 'binance-usd';
        $symbol->sort_order = 4;
        $symbol->save();

        $symbol = new Symbol();
        $symbol->title = 'Dai';
        $symbol->symbol = 'DAI';
        $symbol->coingecko_id = 'dai';
        $symbol->sort_order = 5;
        $symbol->save();
    }
}
