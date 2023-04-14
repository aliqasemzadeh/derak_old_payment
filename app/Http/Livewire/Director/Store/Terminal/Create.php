<?php

namespace App\Http\Livewire\Director\Store\Terminal;

use App\Models\Store;
use App\Models\Terminal;
use Irfa\SerialNumber\Facades\SerialNumber;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use LivewireAlert;
    use WithFileUploads;

    public Store $store;
    public $store_id;
    public $type = 'crypto';
    public $title;
    public $username;
    public $callback_password;
    public $callback_url;

    public function mount(Store $store)
    {
        $this->merchant = $store;
    }

    public function create()
    {
        if($this->type == 'crypto') {
            $this->validate([
                'title' => 'required|string',
                'username' => 'nullable|required|string|unique:terminals',
                'callback_url' => 'required|url',
                'callback_password' => 'required|string',
            ]);

            $terminal = new Terminal();
            $terminal->title = $this->title;
            $terminal->type = $this->type;
            $terminal->username = $this->username;
            $terminal->user_id = auth()->user()->id;
            $terminal->merchant_id = $this->merchant->id;
            $terminal->callback_url = $this->callback_url;
            $terminal->callback_password = $this->callback_password;
            $terminal->api_key = SerialNumber::generate();
            $terminal->save();

        } else {
            $this->validate([
                'title' => 'required|string',
                'username' => 'nullable|string|unique:terminals',
            ]);

            $terminal = new Terminal();
            $terminal->title = $this->title;
            $terminal->type = $this->type;
            $terminal->username = $this->username;
            $terminal->user_id = auth()->user()->id;
            $terminal->merchant_id = $this->merchant->id;
            $terminal->api_key = SerialNumber::generate();
            $terminal->save();
        }


        $this->emitTo(\App\Http\Livewire\Director\Store\Terminal\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.created'));
    }

    public function render()
    {
        return view('livewire.director.store.terminal.create');
    }
}
