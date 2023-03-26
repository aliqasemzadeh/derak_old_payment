<?php
return [
    'BEP20' => [
        'title' => 'BEP20',
        'explorer_address' => 'https://bscscan.com/address/',
        'explorer_transaction' => 'https://bscscan.com/tx/',
        'class' => App\Networks\Binance::class
    ],
    'ERC20' => [
        'title' => 'ERC20',
        'explorer_address' => 'https://etherscan.io/address/',
        'explorer_transaction' => 'https://etherscan.io/tx/',
        'class' => App\Networks\Ethereum::class
    ],
    'TRC20' => [
        'title' => 'TRC20',
        'explorer_address' => 'https://tronscan.org/#/address/',
        'explorer_transaction' => 'https://tronscan.org/#/transaction/',
        'class' => App\Networks\Tron::class
    ],
    'BTC' => [
        'title' => 'BTC',
        'explorer_address' => 'https://mempool.space/address/',
        'explorer_transaction' => 'https://mempool.space/tx/',
        'class' => App\Networks\Bitcoin::class
    ],
];
