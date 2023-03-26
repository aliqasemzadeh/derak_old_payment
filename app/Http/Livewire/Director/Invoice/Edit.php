<?php

namespace App\Http\Livewire\Director\Invoice;

use App\Models\Invoice;
use App\Models\Symbol;
use App\Models\Terminal;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;
    public Invoice $invoice;
    public float $total;
    public $terminal_id;
    public $email;
    public string $description;
    public array $symbols;

    public function mount(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->description = $invoice->description;
        $this->terminal_id = $invoice->terminal_id;
        $this->total = $invoice->total;
        $this->email = $invoice->email;
    }
    public function edit() : void
    {
        $this->validate([
            'terminal_id' => 'required|numeric',
            'total' => 'required|numeric',
            'description' => 'required|string',
        ]);

        $invoice = $this->invoice;
        $invoice->description = $this->description;
        $invoice->user_id = auth()->user()->id;
        $invoice->terminal_id = $this->terminal_id;
        $invoice->total = $this->total;
        $invoice->email = $this->email;
        $invoice->save();

        $this->emitTo(\App\Http\Livewire\Director\Invoice\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.edited'));
    }
    public function render()
    {
        $terminals = Terminal::where('user_id', auth()->user()->id)->get();
        $symbolItems = Symbol::all();
        return view('livewire.director.invoice.edit', compact('terminals', 'symbolItems'));
    }
}
