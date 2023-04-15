<?php

namespace App\Http\Livewire\Director\Store;

use App\Models\Store;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $selectedItems = [];
    public $selectAll = false;

    public $store;
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
            $this->selectedItems = Store::pluck('id')->where('user_id', auth()->user()->id)->toArray();
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
    public function delete(Store $store)
    {
        $this->confirm(__('bap.are_you_sure'), [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => __('bap.cancel'),
            'onConfirmed' => 'confirmedDeleteItem',
            'onCancelled' => 'cancelledDeleteItem'
        ]);
        $this->store = $store;
    }

    public function confirmedDeleteItem()
    {
        $this->store->delete();
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
        Store::query()
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
        $stores = Store::filter(['search' => $this->search])->paginate($this->perPage);
        return view('livewire.director.store.index', compact('stores'))->layout('layouts.director');
    }
}
