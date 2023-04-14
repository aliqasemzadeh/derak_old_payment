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

    public Store $store;
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
        $store = $this->merchant;
        $store->note = $this->note;
        $store->status = 'enable';
        $store->save();


        $this->emitTo(\App\Http\Livewire\Director\Store\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.accepted'));
    }

    public function reject()
    {
        $store = $this->merchant;
        $store->note = $this->note;
        $store->status = 'reject';
        $store->save();

        $this->emitTo(\App\Http\Livewire\Director\Store\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.rejected'));
    }

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
    public function render()
    {
        return view('livewire.director.store.verify');
    }
}
