<?php

namespace App\Http\Livewire\Store\Dashboard;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.store.dashboard.index')->layout('layouts.store');
    }
}
