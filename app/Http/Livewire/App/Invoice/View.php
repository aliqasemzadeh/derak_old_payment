<?php

namespace App\Http\Livewire\App\Invoice;

use App\Models\Invoice;
use App\Models\Symbol;
use Livewire\Component;

class View extends Component
{
    public Invoice $invoice;
    public $email;
    public $phone;
    public function mount(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function selectPayment($method)
    {
        $this->validate([
            'email' => 'required|email',
            'phone' => 'nullable',
        ]);

        if($method == 'crypto') {
            $this->emit('showModal', 'app.invoice.crypto', [$this->invoice->id]);
        }

    }

    public function render()
    {
        $symbols = Symbol::all();
        return view('livewire.app.invoice.view', compact('symbols'));
    }
}
