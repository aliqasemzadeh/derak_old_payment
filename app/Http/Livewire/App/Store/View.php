<?php

namespace App\Http\Livewire\App\Store;

use App\Models\Store;
use Livewire\Component;

class View extends Component
{
    public Store $store;

    public function mount(Store $store)
    {
        $this->store = $store;
    }
    public function render()
    {
        return view('livewire.app.store.view');
    }
}
