<?php

namespace App\Http\Livewire\Admin\Payment\XPub;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;

    public $type;
    public $xpub;
    public $name;
    public $symbol;

    public function create()
    {
        if(!auth()->user()->can('admin_xpub_create')) {
            return abort(403);
        }

        $this->validate([
            'name' => ['string', 'required'],
            'type' => 'required',
            'xpub' => 'required',
            'symbol' => 'required',
        ]);

        $xpub = new Xpub();
        $xpub->name = $this->name;
        $xpub->type = $this->type;
        $xpub->xpub = $this->xpub;
        $xpub->symbol = $this->symbol;
        $xpub->last = 0;
        $xpub->save();

        activity()->log('Add xPub:'.$xpub->id);

        $this->emitTo(\App\Http\Livewire\Admin\Payment\Xpub\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.created'));
    }

    public function confirmedDeleteXpub()
    {
        $this->xpub->delete();
        $this->emit('updateList');
        $this->alert(
            'success',
            __('bap.removed')
        );
    }

    public function cancelledDeleteXpub()
    {
        $this->alert(
            'success',
            __('bap.cancelled')
        );
    }

    public function render()
    {
        $symbols = Symbol::orderBy('sort_order')->get();
        return view('livewire.admin.payment.x-pub.create');
    }
}
