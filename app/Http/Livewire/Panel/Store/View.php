<?php

namespace App\Http\Livewire\Panel\Store;

use App\Models\Store;
use App\Models\StoreToken;
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
        $tokens = StoreToken::where('store_id', $this->store->id)->get();
        return view('livewire.panel.store.view')->layout('layouts.panel');
    }
}
