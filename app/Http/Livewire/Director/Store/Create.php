<?php

namespace App\Http\Livewire\Director\Store;

use App\Models\Store;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $title;
    public $website;
    public $email;
    public $phone;
    public $address;
    public $logo;
    public $description;
    public $payment_type = [];

    public function create()
    {
        $this->validate([
           'title' => 'required',
           'phone' => 'required',
           'email' => 'required|email',
           'address' => 'required',
           'description' => 'nullable',
           'website' => 'nullable|url',
           'logo' => 'required|image',
           'payment_type' => 'required|array',
        ]);

        $store = new Store();
        $store->title = $this->title;
        $store->phone = $this->phone;
        $store->email = $this->email;
        $store->address = $this->address;
        $store->description = $this->description;
        $store->website = $this->website;
        $store->logo = $this->logo->store('store_logos');
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
                    $store->fiat = 'verify';
                } else {
                    $store->fiat = 'disable';
                }
            }
        }
        $store->save();

        $this->emitTo(\App\Http\Livewire\Director\Store\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.created'));
    }
    public function render()
    {
        return view('livewire.director.store.create');
    }
}
