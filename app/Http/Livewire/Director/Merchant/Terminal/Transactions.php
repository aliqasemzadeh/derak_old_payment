<?php

namespace App\Http\Livewire\Director\Merchant\Terminal;

use App\Models\Terminal;
use Livewire\Component;

class Transactions extends Component
{
    public Terminal $terminal;

    public function mount(Terminal $terminal)
    {
        $this->terminal = $this->terminal;

    }

    public function render()
    {
        return view('livewire.director.merchant.terminal.transactions')->layout('layouts.director');
    }
}
