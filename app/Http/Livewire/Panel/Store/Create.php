<?php

namespace App\Http\Livewire\Panel\Store;

use App\Models\Store;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $store_id;
    public $title;
    public $email;
    public $logo;
    public $phone;
    public $address;
    public $description;

    public function create()
    {
        $this->validate([
            'title' => 'required|string',
            'store_id' => 'string|unique:stores|nullable',
            'email' => 'nullable|email',
            'logo' => 'nullable|image',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $store = new Store();
        $store->title = $this->title;
        $store->user_id = auth()->user()->id;
        $store->store_id = $this->store_id;
        $store->email = $this->email;
        $store->address = $this->address;
        $store->phone = $this->phone;
        $store->description = $this->description;
        $store->logo = $this->logo->store('store_logos');
        $store->save();

        $this->emitTo(\App\Http\Livewire\Panel\Store\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.created'));
    }
    public function render()
    {
        return view('livewire.panel.store.create');
    }
}
