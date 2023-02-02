<?php

namespace App\Http\Livewire\Panel\Merchant;

use App\Models\Merchant;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public $merchant;
    public $title;
    public $website;
    public $email;
    public $phone;
    public $address;
    public $logo;
    public $description;
    public $payment_type = [];

    public function mount(Merchant $merchant)
    {
        $this->merchant = $merchant;
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

        $merchant = $this->merchant;
        $merchant->title = $this->title;
        $merchant->phone = $this->phone;
        $merchant->email = $this->email;
        $merchant->address = $this->address;
        $merchant->description = $this->description;
        $merchant->website = $this->website;
        if($this->logo) {
            Storage::delete($merchant->logo);
            $merchant->logo = $this->logo->store('merchant_logos');
        }
        $merchant->user_id = auth()->user()->id;

        foreach ($this->payment_type as $key => $payment_type) {
            if($key == 'crypto') {
                if($payment_type) {
                    $this->crypto = 'enable';
                } else {
                    $this->crypto = 'disable';
                }
            }

            if($key == 'fiat') {
                if($payment_type) {
                    if($this->merchant->fiat == 'enable')  {
                        $this->fiat = 'enable';
                    } else {
                        $this->fiat = 'verify';
                    }
                } else {
                    $this->crypto = 'disable';
                }
            }

        }
        $merchant->save();

        $this->emitTo(\App\Http\Livewire\Panel\Merchant\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.edited'));
    }
    public function render()
    {
        return view('livewire.panel.merchant.edit');
    }
}
