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
        $symbol->sort_order = 2;
        $symbol->save();

        $symbol = new Symbol();
        $symbol->title = 'Tether';
        $symbol->symbol = 'USDT';
        $symbol->coingecko_id = 'tether';
        $symbol->sort_order = 2;
        $symbol->save();
    }
}
