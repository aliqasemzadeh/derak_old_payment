<?php

namespace App\Http\Livewire\Panel\Store;

use App\Models\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $store;
    public $store_id;
    public $title;
    public $email;
    public $logo;
    public $phone;
    public $address;
    public $description;

    public function mount(Store $store)
    {
        $this->store = $store;
        $this->title = $store->title;
        $this->store_id = $store->store_id;
        $this->email = $store->email;
        $this->address = $store->address;
        $this->phone = $store->phone;
        $this->description = $store->description;
    }
    public function edit()
    {
        $this->validate([
            'title' => 'required|string',
            'store_id' => ['string', 'nullable', Rule::unique('stores')->ignore($this->store->id)],
            'email' => 'nullable|email',
            'logo' => 'nullable|image',
            'address' => 'nullable|string',
            'phone' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $store = $this->store;
        $store->title = $this->title;
        $store->user_id = auth()->user()->id;
        $store->store_id = $this->store_id;
        $store->email = $this->email;
        $store->address = $this->address;
        $store->phone = $this->phone;
        $store->description = $this->description;
        if($store->logo) {
            Storage::delete($store->logo);
            $store->logo = $this->logo->store('store_logos');
        }

        $store->save();

        $this->emitTo(\App\Http\Livewire\Panel\Store\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.edited'));
    }
    public function render()
    {
        return view('livewire.panel.store.edit');
    }
}
