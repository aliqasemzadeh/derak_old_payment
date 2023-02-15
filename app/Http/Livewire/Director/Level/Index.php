<?php

namespace App\Http\Livewire\Director\Level;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.director.level.index')->layout('layouts.director');
    }
}
