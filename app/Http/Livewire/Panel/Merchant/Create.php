<?php

namespace App\Http\Livewire\Panel\Store;

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

        $merchant = new Store();
        $merchant->title = $this->title;
        $merchant->phone = $this->phone;
        $merchant->email = $this->email;
        $merchant->address = $this->address;
        $merchant->description = $this->description;
        $merchant->website = $this->website;
        $merchant->logo = $this->logo->store('merchant_logos');
        $merchant->user_id = auth()->user()->id;

        foreach ($this->payment_type as $key => $payment_type) {
            if($key == 'crypto') {
                if($payment_type) {
                    $merchant->crypto = 'enable';
                } else {
                    $merchant->crypto = 'disable';
                }
            }

            if($key == 'fiat') {
                if($payment_type) {
                    $merchant->fiat = 'verify';
                } else {
                    $merchant->fiat = 'disable';
                }
            }
        }
        $merchant->save();

        $this->emitTo(\App\Http\Livewire\Panel\Store\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.created'));
    }
    public function render()
    {
        return view('livewire.panel.merchant.create');
    }
}
