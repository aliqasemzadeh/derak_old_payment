<?php

namespace App\Http\Livewire\Panel\Invoice;

use App\Models\Invoice;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $selectedItems = [];
    public $selectAll = false;

    public $invoice;
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

    public function mount()
    {
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

    public function updatedSelectAll($value)
    {
        if($value) {
            $this->selectedItems = Invoice::pluck('id')->where('user_id', auth()->user()->id)->toArray();
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
        Invoice::query()
            ->where('user_id', auth()->user()->id)
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
        return view('livewire.panel.invoice.index')->layout('layouts.panel');
    }
}
