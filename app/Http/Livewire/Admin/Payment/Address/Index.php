<?php

namespace App\Http\Livewire\Admin\Payment\Address;

use App\Exports\AddressesExport;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    public function export()
    {
        return Excel::download(new AddressesExport(3), 'addresses-'.date('Y-m-d').'.xlsx');
    }

    public function render()
    {
        return view('livewire.admin.payment.address.index')->layout('layouts.admin');
    }
}
