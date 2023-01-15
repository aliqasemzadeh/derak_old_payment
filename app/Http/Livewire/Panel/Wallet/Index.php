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
        return view('livewire.panel.wallet.index')->layout('layouts.panel');
    }
}
