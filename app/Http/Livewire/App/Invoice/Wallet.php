<?php

namespace App\Http\Livewire\App\Invoice;

use App\Models\Invoice;
use Livewire\Component;

class Wallet extends Component
{
    public Invoice $invoice;
    public function mount(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }
    public function render()
    {
        return view('livewire.app.invoice.wallet');
    }
}
