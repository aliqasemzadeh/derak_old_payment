<?php

namespace App\Http\Livewire\Director\Merchant\Terminal;

use App\Models\Merchant;
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
        return view('livewire.director.merchant.terminal.view');
    }
}
