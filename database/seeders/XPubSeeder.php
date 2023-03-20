<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\XPub;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class XPubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $xpub = new XPub();
        $xpub->name = "wallet_18";
        $xpub->type = "zpub";
        $xpub->xpub = "zpub6n7NrKuAzTwp3kZV6Fe45MTyrTdCeffS7dXTn1yBu7exaP8Z8JWGsccVe77REaxmGEQzn6ujAJLR3mLTABh1rzWbG7EWdgYTb2nsDEpdyHf";
        $xpub->symbol = "BTC";
        $xpub->last = 0;
        $xpub->save();
    }
}
