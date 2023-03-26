<?php

namespace App\Utils;

class MoneyUtil
{
    public static function changeToFloat($amount, $precision = 8) : float
    {
        return floatval(round($amount / pow(10, $precision), $precision ,PHP_ROUND_HALF_DOWN));
    }

    public static function changeToString($amount, $precision = 8) : string
    {
        return strval($amount * pow(10, $precision));
    }

    public static function display($amount, $network, $symbol)
    {
        if(config('symbol.' . $symbol . '.' . $network . '.have_precision')) {
            return strval(self::changeToFloat($amount, config('symbol.' . $symbol . '.' . $network . '.precision')));

        }
        return strval($amount);
    }
}
