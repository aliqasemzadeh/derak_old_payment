<?php

namespace App\Http\Livewire\Panel\Invoice;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.panel.invoice.index')->layout('layouts.panel');
    }
}
