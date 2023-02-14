<?php

namespace App\Http\Livewire\Director\Dashboard;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.director.dashboard.index')->layout('layouts.director');
    }
}
