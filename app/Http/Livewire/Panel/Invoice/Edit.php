<?php

namespace App\Http\Livewire\Panel\Invoice;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;
    public function render()
    {
        return view('livewire.panel.invoice.edit');
    }
}
