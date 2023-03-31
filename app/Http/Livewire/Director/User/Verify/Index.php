<?php

namespace App\Http\Livewire\Director\User\Verify;

use App\Models\User;
use App\Models\UserVerify;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $selectedItems = [];
    public $selectAll = false;

    public $user;
    public $search = 'wait';
    public $perPage = 15;
    public $sortColumn = 'created_at';
    public $sortDirection = 'asc';

    protected $paginationTheme = 'bootstrap';

    protected $queryString = ['search'];

    protected $listeners = [
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

    public function updatedSelectAll($value)
    {
        if($value) {
            $this->selectedItems = UserVerify::pluck('id')->toArray();
        } else {
            $this->selectedItems = [];
        }

    }

    public function render()
    {
        if(!auth()->user()->can('director_user_verify')) {
            return abort(403);
        }
        $verifies = UserVerify::filter(['search' => $this->search])->with(['user'])->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);
        return view('livewire.director.user.verify.index', compact('verifies'))->layout('layouts.director');
    }
}
