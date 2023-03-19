<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rate extends Model
{
    use HasFactory;
    use SoftDeletes;

    public static function getPrice($symbol)
    {
        if (Cache::has($symbol.'_rate')) {
            return Cache::get($symbol.'_rate');
        } else {
            if(isset(\App\Models\Rate::where('symbol', $symbol)->latest()->first()->price)) {
                $price = (float) \App\Models\Rate::where('symbol', $symbol)->latest()->first()->price;
                if(round($price, 8, PHP_ROUND_HALF_DOWN) == 0) {
                    Cache::put($symbol.'_rate', "N/A");
                } else {
                    Cache::put($symbol.'_rate', rtrim(rtrim(sprintf("%10.8f", $price), '0'), '.'));
                }

            } else {
                Cache::put($symbol.'_rate', "N/A");
            }
        }
    }
}
