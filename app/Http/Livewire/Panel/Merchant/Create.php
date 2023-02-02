<?php

namespace App\Http\Livewire\Panel\Merchant;

use App\Models\Merchant;
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

        $merchant = new Merchant();
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
                    $this->crypto = 'enable';
                } else {
                    $this->crypto = 'disable';
                }
            }

            if($key == 'fiat') {
                if($payment_type) {
                    $this->fiat = 'verify';
                } else {
                    $this->fiat = 'disable';
                }
            }

        }
        $merchant->save();

        $this->emitTo(\App\Http\Livewire\Panel\Merchant\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.created'));
    }
    public function render()
    {
        return view('livewire.panel.merchant.create');
    }
}
