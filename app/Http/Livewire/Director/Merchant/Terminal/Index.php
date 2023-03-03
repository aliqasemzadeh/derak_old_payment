<?php

namespace App\Http\Livewire\Director\Merchant\Terminal;

use App\Models\Merchant;
use Livewire\Component;

class Index extends Component
{
    public Merchant $merchant;

    public function mount(Merchant $merchant)
    {

    }

    public function render()
    {
        return view('livewire.director.merchant.terminal.index')->layout('layouts.director');
    }
}
