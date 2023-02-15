<?php

namespace App\Http\Livewire\Director\Merchant;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.director.merchant.index')->layout('layouts.director');
    }
}
