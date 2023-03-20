<?php

namespace App\Http\Livewire\Admin\Payment\XPub;

use App\Models\XPub;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Address extends Component
{
    use LivewireAlert;

    public XPub $xpubItem;
    public $search = "";

    public function mount(XPub $xpub)
    {
        $this->xpubItem = $xpub;
    }
    public function render()
    {
        if($this->search != "") {
            $addresses = \App\Models\Address::where('xpub_id', $this->xpubItem->id)->where('name', 'like', '%'.$this->search.'%')->get();
        } else {
            $addresses = \App\Models\Address::where('xpub_id', $this->xpubItem->id)->get();
        }

        return view('livewire.admin.payment.x-pub.address', compact('addresses'));
    }
}
