<?php

namespace App\Http\Livewire\Panel\Wallet;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.panel.wallet.index')->layout('layouts.panel');
    }
}
