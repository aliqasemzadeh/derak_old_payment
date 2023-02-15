<?php

namespace App\Http\Livewire\Director\Exchange;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.director.exchange.index')->layout('layouts.director');
    }
}
