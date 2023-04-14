<?php

namespace App\Http\Livewire\Panel\Store;

use App\Models\Store;
use Livewire\Component;

class Verify extends Component
{
    public Store $merchant;

    public function mount(Store $merchant)
    {
        $this->merchant = $merchant;
    }
    public function render()
    {
        return view('livewire.panel.merchant.verify');
    }
}
