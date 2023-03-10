<?php

namespace App\Http\Livewire\Director\Merchant\Terminal;

use App\Models\Symbol;
use App\Models\Terminal;
use App\Models\Transaction;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Transactions extends Component
{
    use WithPagination;
    use LivewireAlert;

    public Terminal $terminal;
    public Transaction $transaction;
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


    public function mount(Terminal $terminal)
    {
        $this->search = request()->query('search', $this->search);
        $this->terminal = $terminal;
    }

    public function clear()
    {
        $this->search = "";
    }

    public function setPerPage($perPage)
    {
        $this->perPage = $perPage;
    }

    public function updatedSelectAll($value)
    {
        if($value) {
            $this->selectedItems = Transaction::pluck('id')->where('type', 'Terminal')->where('linker_id', $this->terminal->id)->toArray();
        } else {
            $this->selectedItems = [];
        }

    }

    public function updatedSelectedItems($value)
    {
        if($this->selectAll) {
            $this->selectAll = false;
        }
    }
    public function delete(Transaction $transaction)
    {
        $this->confirm(__('bap.are_you_sure'), [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => __('bap.cancel'),
            'onConfirmed' => 'confirmedDeleteItem',
            'onCancelled' => 'cancelledDeleteItem'
        ]);
        $this->transaction = $transaction;
    }

    public function confirmedDeleteItem()
    {
        if(auth()->user()->id != $this->transaction->user_id) {
            return abort(403);
        }

        $this->transaction->delete();
        $this->emit('updateList');
        $this->alert(
            'success',
            __('bap.removed')
        );
    }

    public function cancelledDeleteItem()
    {
        $this->alert(
            'success',
            __('bap.cancelled')
        );
    }

    public function archiveSelected()
    {
        $this->confirm(__('bap.are_you_sure'), [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => __('bap.cancel'),
            'onConfirmed' => 'archiveSelectedQuery',
            'onCancelled' => 'cancelledDelete'
        ]);
    }

    public function deleteSelectedQuery()
    {
        Transaction::query()
            ->whereIn('id', $this->selectedItems)
            ->delete();
        $this->selectedItems = [];
        $this->selectAll = false;

        $this->alert(
            'success',
            __('bap.removed')
        );
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
        $transactions = Transaction::where('type', 'Terminal')->where('linker_id', $this->terminal->id)->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);
        return view('livewire.director.merchant.terminal.transactions', compact('transactions'))->layout('layouts.director');
    }
}
