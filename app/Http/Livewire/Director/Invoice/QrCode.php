<?php

namespace App\Http\Livewire\Director\Invoice;

use App\Models\Invoice;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class QrCode extends Component
{
    use LivewireAlert;
    public Invoice $invoice;
    public function mount(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }
    public function render()
    {
        return view('livewire.director.invoice.qr-code');
    }
}
