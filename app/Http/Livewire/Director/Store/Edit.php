<?php

namespace App\Http\Livewire\Director\Store;

use App\Models\Store;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $store;
    public $title;
    public $website;
    public $email;
    public $phone;
    public $address;
    public $logo;
    public $description;
    public $payment_type = [];

    public function mount(Store $store)
    {
        $this->merchant = $store;
        $this->title = $this->merchant->title;
        $this->phone = $this->merchant->phone;
        $this->email = $this->merchant->email;
        $this->address = $this->merchant->address;
        $this->description = $this->merchant->description;
        $this->website = $this->merchant->website;
        if($this->merchant->fiat != 'disable') {
            $this->payment_type['fiat'] = true;
        }
        if($this->merchant->crypto != 'disable') {
            $this->payment_type['crypto'] = true;
        }
    }
    public function edit()
    {
        $this->validate([
            'title' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'description' => 'nullable',
            'website' => 'nullable|url',
            'logo' => 'nullable|image',
            'payment_type' => 'required|array',
        ]);

        $store = $this->merchant;
        $store->title = $this->title;
        $store->phone = $this->phone;
        $store->email = $this->email;
        $store->address = $this->address;
        $store->description = $this->description;
        $store->website = $this->website;
        if($this->logo) {
            Storage::delete($store->logo);
            $store->logo = $this->logo->store('store_logos');
        }
        $store->user_id = auth()->user()->id;

        foreach ($this->payment_type as $key => $payment_type) {
            if($key == 'crypto') {
                if($payment_type) {
                    $store->crypto = 'enable';
                } else {
                    $store->crypto = 'disable';
                }
            }

            if($key == 'fiat') {
                if($payment_type) {
                    if($this->merchant->fiat == 'enable')  {
                        $store->fiat = 'enable';
                    } else {
                        $store->fiat = 'verify';
                    }
                } else {
                    $store->fiat = 'disable';
                }
            }

        }
        $store->save();

        $this->emitTo(\App\Http\Livewire\Director\Store\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.edited'));
    }
    public function render()
    {
        return view('livewire.director.store.edit')->layout('layouts.director');;
    }
}
