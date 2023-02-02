<?php

namespace App\Http\Livewire\Panel\Merchant;

use App\Models\Merchant;
use Livewire\Component;

class View extends Component
{
    public Merchant $merchant;

    public function mount(Merchant $merchant)
    {
        $this->merchant = $merchant;
    }
    public function render()
    {
        return view('livewire.panel.merchant.view');
    }
}
