<?php

namespace App\Http\Livewire\Director\Wallet;

use App\Exports\TransactionsExport;
use App\Models\Transaction;
use App\Models\Wallet;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{

    public function exportTransactions($symbol)
    {
        return Excel::download(new TransactionsExport(Transaction::whereIn('wallet_id', Wallet::select('id')->where('symbol', $symbol)->get())->pluck('id')->toArray()), "transactions-".$symbol."-".date('Y-m-d').".xlsx");
    }

    public function render()
    {
        $wallets = [];
        foreach (config('wallet') as $symbol => $value) {
            $wallets[$symbol]['symbol'] = $symbol;
            $wallets[$symbol]['balance'] = Transaction::whereIn('wallet_id', Wallet::select('id')->where('symbol', $symbol)->get())->sum('amount');
        }
        $wallets = collect($wallets);
        return view('livewire.director.wallet.index', compact('wallets'))->layout('layouts.director');
    }
}
