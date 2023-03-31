<?php

namespace App\Http\Livewire\Director\User\Wallet;

use App\Models\Rate;
use App\Models\Transaction;
use App\Models\Wallet;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CreateTransaction extends Component
{
    use LivewireAlert;

    public $wallet;
    public $amount;
    public $type;
    public $note;
    public $linker_id;

    public function mount(Wallet $wallet, $linker_id = null)
    {
        $this->wallet = $wallet;
        if($linker_id) {
            $this->linker_id = $linker_id;
        }
    }

    public function create()
    {
        $this->validate([
            'amount' => 'required',
            'type' => 'required',
        ]);

        $transaction = Transaction::firstOrCreate([
            'type' => $this->type,
            'linker_id' =>  $this->linker_id,
            'wallet_id' => $this->wallet->id,
        ]);

        $transaction->amount = round($this->amount, 8, PHP_ROUND_HALF_UP);
        $transaction->note = $this->note;
        $transaction->save();

        activity()->log('Create Transaction:'. $transaction->id."-Type:".$transaction->type);

        $this->emit('hideModal');
        $this->alert('success', __('bap.created'));
    }

    public function render()
    {
        return view('livewire.director.user.wallet.create-transaction');
    }
}
