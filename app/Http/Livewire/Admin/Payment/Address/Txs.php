<?php

namespace App\Http\Livewire\Admin\Payment\Address;

use App\Models\Address;
use App\Models\AddressTransaction;
use Livewire\Component;

class Txs extends Component
{
    public $address;
    public function mount($address)
    {
        $this->address = Address::withExpired()->findOrFail($address);
    }
    public function render()
    {
        $txs = AddressTransaction::where('address_id', $this->address->id)->get();
        return view('livewire.admin.payment.address.txs', compact('txs'));
    }
}
