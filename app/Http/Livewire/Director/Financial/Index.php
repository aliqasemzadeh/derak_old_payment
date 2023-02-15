<?php

namespace App\Http\Livewire\Director\Financial;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.director.financial.index')->layout('layouts.director');
    }
}
