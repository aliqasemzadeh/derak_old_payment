<?php

namespace App\Http\Livewire\Director\Merchant;

use App\Models\Merchant;
use Livewire\Component;

class Verify extends Component
{
    public Merchant $merchant;

    public function mount(Merchant $merchant)
    {
        $this->merchant = $merchant;
    }
    public function render()
    {
        return view('livewire.director.merchant.verify');
    }
}
