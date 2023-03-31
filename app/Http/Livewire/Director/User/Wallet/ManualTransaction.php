<?php

namespace App\Http\Livewire\Director\User\Wallet;

use App\Models\ManualDeposit;
use App\Models\Transaction;
use App\Models\Wallet;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ManualTransaction extends Component
{
    use LivewireAlert;

    public $wallet;
    public $type;
    public $amount;
    public $note;
    public $linker_id;

    public function mount(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    public function create()
    {
        $this->validate([
            'type' => 'required',
            'amount' => 'required',
        ]);

        $manual = new ManualDeposit();
        $manual->amount = round($this->amount, 8, PHP_ROUND_HALF_UP);
        $manual->type = $this->type;
        $manual->wallet_id = $this->wallet->id;
        $manual->save();

        $transaction = Transaction::firstOrCreate([
            'type' => $this->type,
            'linker_id' =>  $manual->id,
            'wallet_id' => $this->wallet->id,
        ]);

        $transaction->amount = round($manual->amount, 8, PHP_ROUND_HALF_UP);
        $transaction->note = $this->note;
        $transaction->save();

        activity()->log('Manual Transaction:'. $transaction->id."-Type:".$transaction->type);

        $this->emit('hideModal');
        $this->alert('success', __('bap.created'));
    }

    public function render()
    {
        return view('livewire.director.user.wallet.manual-transaction');
    }
}
