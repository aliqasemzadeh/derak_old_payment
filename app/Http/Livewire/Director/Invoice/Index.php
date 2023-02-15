<?php

namespace App\Http\Livewire\Director\Invoice;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.director.invoice.index')->layout('layouts.director');
    }
}
