<?php

namespace App\Http\Livewire\Director\Financial\Symbol;

use App\Models\Symbol;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $title;
    public $symbol;
    public $coingecko_id;
    public $sort_order;

    public function create()
    {
        $this->validate([
            'title' => 'required',
            'symbol' => 'required',
            'coingecko_id' => 'required',
            'sort_order' => 'required',
        ]);

        $symbol = new Symbol();
        $symbol->title = $this->title;
        $symbol->symbol = $this->symbol;
        $symbol->coingecko_id = $this->coingecko_id;
        $symbol->sort_order = $this->sort_order;
        $symbol->save();

        $this->emitTo(\App\Http\Livewire\Director\Financial\Symbol\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.created'));
    }

    public function render()
    {
        return view('livewire.director.financial.symbol.create');
    }
}
