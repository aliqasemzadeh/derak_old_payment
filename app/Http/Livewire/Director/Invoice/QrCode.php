<?php

namespace App\Http\Livewire\Director\Invoice;

use App\Models\Invoice;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class QrCode extends Component
{
    use LivewireAlert;
    public \App\Models\Invoice $invoice;
    public function mount($invoice)
    {
        $this->invoice = \App\Models\Invoice::withExpired()->findOrFail($invoice);
    }
    public function render()
    {
        return view('livewire.director.invoice.qr-code');
    }
}
