<?php

namespace App\Http\Livewire\Director\Merchant;

use App\Models\Merchant;
use Livewire\Component;

class Verify extends Component
{
    public Merchant $merchant;

    public function verify()
    {

    }

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
    public function render()
    {
        return view('livewire.director.merchant.verify');
    }
}
