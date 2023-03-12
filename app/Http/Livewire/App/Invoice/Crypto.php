<?php

namespace App\Http\Livewire\App\Invoice;

use App\Models\Invoice;
use App\Models\Symbol;
use Livewire\Component;

class Crypto extends Component
{
    public Invoice $invoice;
    public $symbol;
    public $email;
    public $name;
    public $phone;
    public $address;
    public $showAddress = false;
    public function mount(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function payment()
    {
        $this->validate([
            'symbol'  => 'required|string',
            'email'  => 'required|email',
            'phone'  => 'string|nullable',
            'address'  => 'string|nullable',
            'name'  => 'string|nullable',
        ]);

        $this->invoice->name = $this->name;
        $this->invoice->email = $this->email;
        $this->invoice->phone = $this->phone;
        $this->invoice->address = $this->address;
        $this->invoice->save();

        $this->showAddress = true;

        $this->alert('success', __('bap.pay_amount_to_address'));
    }
    public function render()
    {
        $symbols = Symbol::all();
        return view('livewire.app.invoice.crypto', compact('symbols'));
    }
}
