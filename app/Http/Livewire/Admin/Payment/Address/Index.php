<?php

namespace App\Http\Livewire\Admin\Payment\Address;

use App\Exports\AddressesExport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    public $count = 100;
    public $network = 'BEP20';
    public function export()
    {
        dd($this->network);
        return Excel::download(new AddressesExport($this->count, $this->network), 'addresses-'.$this->network.'-'.date('Y-m-d').'-'.time().'.xlsx');
    }

    public function render()
    {
        return view('livewire.admin.payment.address.index')->layout('layouts.admin');
    }
}
