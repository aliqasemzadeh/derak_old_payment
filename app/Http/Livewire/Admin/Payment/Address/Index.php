<?php

namespace App\Http\Livewire\Admin\Payment\Address;

use App\Exports\AddressesExport;
use App\Models\Address;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;

    public $selectedItems = [];
    public $selectAll = false;

    public $address;
    public $search;
    public $perPage = 15;
    public $sortColumn = 'created_at';
    public $sortDirection = 'asc';

    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['search'];

    protected $listeners = [
        'confirmedDelete',
        'cancelledDelete',
        'deleteSelectedQuery',
        'updateList' => 'render'
    ];

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

    public function mount()
    {
        $this->search = request()->query('search', $this->search);
    }

    public function updatedSelectAll($value)
    {
        if($value) {
            $this->selectedItems = Address::pluck('id')->toArray();
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

    public function render()
    {
        if(!auth()->user()->can('admin_address_index')) {
            return abort(403);
        }
        $addresses = Address::withExpired()->filter(['search' => $this->search])->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);
        return view('livewire.admin.payment.address.index', compact('addresses'))->layout('layouts.admin');
    }
}
