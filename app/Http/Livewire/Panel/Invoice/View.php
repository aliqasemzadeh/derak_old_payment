<?php

namespace App\Http\Livewire\Panel\Invoice;

use App\Models\Invoice;
use Livewire\Component;

class View extends Component
{
    public Invoice $invoice;
    public function mount(Invoice $invoice): void
    {
        $this->invoice = $invoice;;
    }
    public function render()
    {
        return view('livewire.panel.invoice.view');
    }
}
