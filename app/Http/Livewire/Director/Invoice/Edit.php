<?php

namespace App\Http\Livewire\Director\Invoice;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;
    public function render()
    {
        return view('livewire.director.invoice.edit');
    }
}
