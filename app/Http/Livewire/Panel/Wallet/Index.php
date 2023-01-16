<?php

namespace App\Http\Livewire\Panel\Wallet;

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
        foreach (config('wallet.networks') as $symbol) {
            $wallet = Wallet::firstOrCreate(['user_id' => $this->user->id, 'symbol' => $symbol]);
            $wallets[] = $wallet;
        }
        $wallets = collect($wallets);

        return view('livewire.panel.wallet.index', compact('wallets'))->layout('layouts.panel');
    }
}
