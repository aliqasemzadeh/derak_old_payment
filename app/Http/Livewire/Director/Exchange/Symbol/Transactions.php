<?php

namespace App\Http\Livewire\Director\Exchange\Symbol;

use App\Models\Symbol;
use App\Models\Transaction;
use App\Models\Wallet;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Transactions extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $selectedItems = [];
    public $selectAll = false;

    public $symbol;
    public $search;
    public $perPage = 15;
    public $sortColumn = 'updated_at';
    public $sortDirection = 'desc';

    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['search'];
    protected $listeners = [
        'confirmedDeleteItem',
        'cancelledDeleteItem',
        'deleteSelectedQuery',
        'updateList' => 'render'
    ];

    public function mount(Symbol $symbol)
    {
        $this->symbol = $symbol;
        $this->search = request()->query('search', $this->search);
    }


    public function clear()
    {
        $this->search = "";
    }

    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
    }

    public function sortByColumn($column)
    {
        if ($this->sortColumn == $column) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->reset('sortDirection');
            $this->sortColumn = $column;
        }
    }

    public function render()
    {
        $transactions = Transaction::whereIn('wallet_id', Wallet::select('id')->where('symbol', $this->symbol->symbol)->get())->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);
        return view('livewire.director.exchange.symbol.transactions', compact('transactions'))->layout('layouts.director');
    }
}
