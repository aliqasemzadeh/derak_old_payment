<?php

namespace App\Http\Livewire\Director\User\Wallet;

use App\Exports\TransactionsExport;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use LivewireAlert;

    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }


    public function exportTransactions($symbol)
    {
        $wallet = \App\Models\Wallet::firstOrCreate(['user_id' => $this->user->id, 'symbol' => $symbol]);
        return Excel::download(new TransactionsExport(\App\Models\Transaction::where('wallet_id', $wallet->id)->pluck('id')->toArray()), "transactions-".$this->user->id."-".date('Y-m-d').".xlsx");
    }

    public function updateBalance(Wallet $wallet)
    {
        $wallet->balance = round(Transaction::where('wallet_id', $wallet->id)->sum('amount'), 8, PHP_ROUND_HALF_DOWN);
        $wallet->save();
        $this->alert('success', __('bap.updated'));
    }

    public function render()
    {
        $wallets = [];
        foreach (config('wallet') as $symbol => $value) {
            $wallet = Wallet::firstOrCreate(['user_id' => $this->user->id, 'symbol' => $symbol]);
            $wallets[] = $wallet;
        }
        $wallets = collect($wallets);
        return view('livewire.director.user.wallet.index', compact('wallets'));
    }
}
