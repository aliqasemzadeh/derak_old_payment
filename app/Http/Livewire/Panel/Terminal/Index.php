<?php

namespace App\Http\Livewire\Panel\Terminal;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.panel.terminal.index')->layout('layouts.panel');
    }
}
