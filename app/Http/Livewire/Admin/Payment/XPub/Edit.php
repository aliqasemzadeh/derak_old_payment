<?php

namespace App\Http\Livewire\Admin\Payment\XPub;

use App\Models\Symbol;
use App\Models\XPub;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;

    public  XPub $xpubItem;
    public $type;
    public $xpub;
    public $name;
    public $symbol;

    public function edit()
    {
        if(!auth()->user()->can('admin_xpub_edit')) {
            return abort(403);
        }

        $this->validate([
            'name' => ['string', 'required'],
            'type' => 'required',
            'xpub' => 'required',
            'symbol' => 'required',
        ]);

        $this->xpubItem->name = $this->name;
        $this->xpubItem->type = $this->type;
        $this->xpubItem->xpub = $this->xpub;
        $this->xpubItem->symbol = $this->symbol;
        $this->xpubItem->save();

        activity()->log('Edit xPub:'.$this->xpubItem->id);

        $this->emitTo(\App\Http\Livewire\Admin\Payment\XPub\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.edited'));
    }

    public function mount(XPub $xpub)
    {
        $this->xpubItem = $xpub;
        $this->name = $this->xpubItem->name;
        $this->type = $this->xpubItem->type;
        $this->xpub = $this->xpubItem->xpub;
        $this->symbol = $this->xpubItem->symbol;
    }
    public function render()
    {
        $symbols = Symbol::orderBy('sort_order')->get();
        return view('livewire.admin.payment.x-pub.edit', compact('symbols'));
    }
}
