<?php

namespace App\Http\Livewire\Panel\Store\Terminal;

use App\Models\Terminal;
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

    protected $queryString = ['search'];
    protected $listeners = [
        'confirmedDeleteItem',
        'cancelledDeleteItem',
        'updateList' => 'render'
    ];

    public function delete(Terminal $terminal)
    {
        if($terminal->user_id != auth()->user()->id) {
            abort('405');
        }
        $this->confirm(__('bap.are_you_sure'), [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'cancelButtonText' => __('bap.cancel'),
            'onConfirmed' => 'confirmedDeleteItem',
            'onCancelled' => 'cancelledDeleteItem'
        ]);
        $this->terminal = $terminal;
    }


    public function confirmedDeleteItem()
    {
        if($this->terminal->user_id != auth()->user()->id) {
            abort('405');
        }
        $this->article->delete();
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

    public function render()
    {
        $terminals = Terminal::where('user_id', auth()->user()->id)->orderBy($this->sortColumn, $this->sortDirection)->paginate($this->perPage);
        return view('livewire.panel.terminal.index', ['terminals' => $terminals])->layout('layouts.panel');
    }
}
