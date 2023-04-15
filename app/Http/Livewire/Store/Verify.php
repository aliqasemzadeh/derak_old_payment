<?php

namespace App\Http\Livewire\Store;

use App\Models\Store;
use Livewire\Component;

class Verify extends Component
{
    public $store;
    public function mount(Store $store)
    {
        $this->store = $store;
        $this->title = $this->store->title;
        $this->phone = $this->store->phone;
        $this->email = $this->store->email;
        $this->address = $this->store->address;
        $this->description = $this->store->description;
        $this->website = $this->store->website;
        if($this->store->fiat != 'disable') {
            $this->payment_type['fiat'] = true;
        }
        if($this->store->crypto != 'disable') {
            $this->payment_type['crypto'] = true;
        }
    }
    public function render()
    {
        return view('livewire.store.verify');
    }
}
