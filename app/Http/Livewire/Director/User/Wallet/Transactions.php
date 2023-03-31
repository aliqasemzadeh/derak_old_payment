<?php

namespace App\Http\Livewire\Director\User\Wallet;

use App\Models\Transaction;
use App\Models\Wallet;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Transactions extends Component
{
    use LivewireAlert;
    use WithPagination;
    public $wallet;
    public $search;
    public $transaction;

    public $sortColumn = 'created_at';
    public $sortDirection = 'desc';

    protected $paginationTheme = 'bootstrap';
    protected $queryString = ['search'];

    protected $listeners = [
        'confirmedDelete',
        'cancelledDelete',
        'updateList' => 'render'
    ];


    public function clear()
    {
        $this->search = "";
    }


    public function mount(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    public function delete(Transaction $transaction)
    {
        $this->confirm(__('bap.are_you_sure'), [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => __('bap.cancel'),
            'onConfirmed' => 'confirmedDelete',
            'onCancelled' => 'cancelledDelete'
        ]);
        $this->transaction = $transaction;
    }

    public function confirmedDelete()
    {
        $this->transaction->delete();
        $this->emit('updateList');
        $this->alert(
            'success',
            __('bap.removed')
        );
    }

    public function cancelledDelete()
    {
        $this->alert(
            'success',
            __('bap.cancelled')
        );
    }

    public function render()
    {
        $transactions = Transaction::filter(['search' => $this->search])->where('wallet_id', $this->wallet->id)->orderBy($this->sortColumn, $this->sortDirection)->paginate(config('bap.per-page'));
        return view('livewire.director.user.wallet.transactions', compact('transactions'));
    }
}
