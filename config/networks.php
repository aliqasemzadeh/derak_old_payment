<?php
return [
    'BEP20' => [
        'class' => App\Networks\Binance::class
    ],
    'ERC20' => [
        'class' => App\Networks\Ethereum::class
    ],
    'TRC20' => [
        'class' => App\Networks\Tron::class
    ],
    'BTC' => [
        'class' => App\Networks\Bitcoin::class
    ],
];
