<?php

namespace App\Http\Livewire\Director\Store\Terminal;

use App\Models\Store;
use App\Models\Terminal;
use Livewire\Component;

class View extends Component
{
    public Terminal $Terminal;

    public function mount(Terminal $terminal)
    {
        $this->terminal = $terminal;
    }

    public function render()
    {
        return view('livewire.director.store.terminal.view');
    }
}
