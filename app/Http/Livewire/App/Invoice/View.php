<?php

namespace App\Http\Livewire\App\Invoice;

use App\Models\Invoice;
use App\Models\Symbol;
use Illuminate\Support\Facades\Log;
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

    public function render()
    {
        $symbols = Symbol::all();
        return view('livewire.app.invoice.view', compact('symbols'));
    }
}
