<?php

namespace App\Http\Livewire\Store\Wallet;

use App\Models\Wallet;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;
    use LivewireAlert;

    public $selectedItems = [];
    public $selectAll = false;

    public $terminal;
    public $search;
    public $perPage = 15;
    public $sortColumn = 'updated_at';
    public $sortDirection = 'desc';

    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $wallets = [];
        foreach (config('wallet') as $symbol => $config) {
            $wallet = Wallet::firstOrCreate(['user_id' => auth()->user()->id, 'symbol' => $symbol]);
            $wallets[] = $wallet;
        }
        $wallets = collect($wallets);

        return view('livewire.store.wallet.index', compact('wallets'))->layout('layouts.store');
    }
}
