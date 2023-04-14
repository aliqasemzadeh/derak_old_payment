<?php

namespace App\Http\Livewire\Director\Store;

use App\Models\Store;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Verify extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public Store $merchant;
    public $title;
    public $website;
    public $email;
    public $phone;
    public $address;
    public $logo;
    public $description;
    public $note;
    public $payment_type = [];
    public function verify()
    {
        $merchant = $this->merchant;
        $merchant->note = $this->note;
        $merchant->status = 'enable';
        $merchant->save();


        $this->emitTo(\App\Http\Livewire\Director\Store\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.accepted'));
    }

    public function reject()
    {
        $merchant = $this->merchant;
        $merchant->note = $this->note;
        $merchant->status = 'reject';
        $merchant->save();

        $this->emitTo(\App\Http\Livewire\Director\Store\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.rejected'));
    }

    public function mount(Store $merchant)
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
