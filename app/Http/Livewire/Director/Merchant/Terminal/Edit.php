<?php

namespace App\Http\Livewire\Director\Merchant\Terminal;

use App\Models\Merchant;
use App\Models\Terminal;
use Irfa\SerialNumber\Facades\SerialNumber;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public Terminal $Terminal;
    public $type = 'crypto';
    public $title;
    public $username;
    public $callback_password;
    public $callback_url;

    public function mount(Terminal $terminal)
    {
        $this->terminal = $terminal;
        $this->type = $terminal->type;
        $this->title = $terminal->title;
        $this->username = $terminal->username;
        $this->callback_password = $terminal->callback_password;
        $this->callback_url = $terminal->callback_url;
    }

    public function edit()
    {

        if($this->type == 'crypto') {
            $this->validate([
                'title' => 'required|string',
                'username' => ['nullable','string', Rule::unique('terminals')->ignore($this->terminal->id)],
                'callback_url' => 'required|url',
                'callback_password' => 'required|string',
            ]);

            $terminal = $this->terminal;
            $terminal->title = $this->title;
            $terminal->type = $this->type;
            $terminal->username = $this->username;
            $terminal->user_id = auth()->user()->id;
            $terminal->callback_url = $this->callback_url;
            $terminal->callback_password = $this->callback_password;
            $terminal->api_key = SerialNumber::generate();
            $terminal->save();

        } else {
            $this->validate([
                'title' => 'required|string',
                'username' => ['nullable','string', Rule::unique('terminals')->ignore($this->terminal->id)],
            ]);

            $terminal = $this->terminal;
            $terminal->title = $this->title;
            $terminal->type = $this->type;
            $terminal->username = $this->username;
            $terminal->user_id = auth()->user()->id;
            $terminal->api_key = SerialNumber::generate();
            $terminal->save();
        }


        $this->emitTo(\App\Http\Livewire\Director\Merchant\Terminal\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.created'));
    }

    public function render()
    {
        return view('livewire.director.merchant.terminal.edit');
    }
}
