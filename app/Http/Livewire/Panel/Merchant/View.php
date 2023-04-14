<?php

namespace App\Http\Livewire\Panel\Store;

use App\Models\Store;
use Livewire\Component;

class View extends Component
{
    public Store $store;

    public function mount(Store $store)
    {
        $this->merchant = $store;
    }
    public function render()
    {
        return view('livewire.panel.merchant.view');
    }
}
