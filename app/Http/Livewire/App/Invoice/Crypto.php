<?php

namespace App\Http\Livewire\App\Invoice;

use App\Models\Invoice;
use App\Models\Symbol;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Crypto extends Component
{
    use LivewireAlert;
    public Invoice $invoice;
    public $symbol;
    public $email;
    public $name;
    public $phone;
    public $address;
    public $search;
    public $user_description;
    public $showSymbol = true;
    public $showNetwork = false;
    public function mount(Invoice $invoice)
    {
        $this->invoice = $invoice;
        $this->invoice->name = $invoice->name;
        $this->invoice->email = $invoice->email;
        $this->invoice->phone = $invoice->phone;
        $this->invoice->address = $invoice->address;
        $this->invoice->user_description = $invoice->user_description;
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
        $this->invoice->user_description = $this->user_description;
        $this->invoice->save();

        $this->showSymbol = false;
        $this->showNetwork = true;

        $this->alert('success', __('bap.please_select_network'));
    }
    public function render()
    {
        $symbols = Symbol::all();
        return view('livewire.app.invoice.crypto', compact('symbols'));
    }
}
