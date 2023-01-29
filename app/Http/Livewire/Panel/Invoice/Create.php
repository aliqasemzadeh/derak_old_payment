<?php

namespace App\Http\Livewire\Panel\Invoice;

use App\Models\Invoice;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;

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
    }

    public function render()
    {
        return view('livewire.panel.invoice.create');
    }
}
