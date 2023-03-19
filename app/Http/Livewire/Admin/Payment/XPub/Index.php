<?php

namespace App\Http\Livewire\Admin\Payment\XPub;

use App\Models\XPub;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $selectedItems = [];
    public $selectAll = false;

    public $xpub;
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
    public function render()
    {
        $xpubs = XPub::latest()->paginate(15);
        return view('livewire.admin.payment.x-pub.index', compact('xpubs'))->layout('layouts.admin');
    }
}
