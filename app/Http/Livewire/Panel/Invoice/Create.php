<?php

namespace App\Http\Livewire\Panel\Invoice;

use App\Models\Invoice;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;

    protected $listeners = [
        'updateList' => 'render'
    ];

    public float $total;
    public string $description;

    public function create() : void
    {
        $this->validate([
            'total' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $invoice = new Invoice();

        $invoice->save();

        $this->emitTo(\App\Http\Livewire\Panel\Invoice\Create::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.created'));
    }

    public function render()
    {
        return view('livewire.panel.invoice.create');
    }
}
