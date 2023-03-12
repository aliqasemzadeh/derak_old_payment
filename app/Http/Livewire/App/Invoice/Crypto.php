<?php

namespace App\Http\Livewire\App\Invoice;

use App\Models\Invoice;
use App\Models\Symbol;
use Livewire\Component;

class Crypto extends Component
{
    public Invoice $invoice;
    public $symbol;
    public $email;
    public $phone;
    public function mount(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function payment()
    {

    }
    public function render()
    {
        $symbols = Symbol::all();
        return view('livewire.app.invoice.crypto', compact('symbols'));
    }
}
