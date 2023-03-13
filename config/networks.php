<?php
return [
    'BEP20' => [
        'title' => 'BEP20',
        'class' => App\Networks\Binance::class
    ],
    'ERC20' => [
        'title' => 'ERC20',
        'class' => App\Networks\Ethereum::class
    ],
    'TRC20' => [
        'title' => 'TRC20',
        'class' => App\Networks\Tron::class
    ],
    'BTC' => [
        'title' => 'Bitcoin',
        'class' => App\Networks\Bitcoin::class
    ],
];
