<?php

namespace App\Http\Livewire\Director\User;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.director.user.index')->layout('layouts.director');
    }
}
