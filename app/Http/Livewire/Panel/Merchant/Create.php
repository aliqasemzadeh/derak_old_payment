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
        dd($this->payment_type);
        $this->validate([
           'title' => 'required',
           'phone' => 'required',
           'address' => 'required',
           'description' => 'nullable',
           'website' => 'nullable|url',
           'logo' => 'required|image',
           'payment_type' => 'required|array',
        ]);

        $merchant = new Merchant();
        $merchant->title = $this->title;
        $merchant->phone = $this->phone;
        $merchant->address = $this->address;
        $merchant->description = $this->description;
        $merchant->website = $this->website;
        $merchant->logo = $this->logo->store('merchant_logos');
        $merchant->user_id = auth()->user()->id;
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
