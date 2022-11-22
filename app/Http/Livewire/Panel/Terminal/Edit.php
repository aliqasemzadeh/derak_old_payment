<?php

namespace App\Http\Livewire\Panel\Terminal;

use App\Models\Terminal;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Edit extends Component
{
    use LivewireAlert;
    public $title;
    public $callback_url;
    public $password;
    public $terminal;

    protected $listeners = [
        'updateList' => 'render'
    ];

    public function mount(Terminal $terminal)
    {
        $this->terminal = $terminal;
        $this->title = $terminal->title;
        $this->callback_url = $terminal->callback_url;
    }


    public function edit()
    {
        $this->validate([
            'title' => 'required|string',
            'callback_url' => 'nullable|url',
            'password' => 'nullable',
        ]);

        $terminal = $this->terminal;
        $terminal->title = $this->title;
        $terminal->callback_url = $this->callback_url;
        if($this->password) {
            $terminal->password = $this->password;
        }
        $terminal->save();

        $this->emitTo(\App\Http\Livewire\Panel\Terminal\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.edited'));

    }

    public function render()
    {
        return view('livewire.panel.terminal.edit');
    }
}
