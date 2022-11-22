<?php

namespace App\Http\Livewire\Panel\Terminal;

use App\Models\Terminal;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Create extends Component
{
    use LivewireAlert;
    public $title;
    public $callback_url;
    public $password;

    protected $listeners = [
        'updateList' => 'render'
    ];


    public function create()
    {
        $this->validate([
            'title' => 'required|string',
            'callback_url' => 'nullable|url',
            'password' => 'nullable',
        ]);

        $terminal = new Terminal();
        $terminal->user_id = auth()->user()->id;
        $terminal->uuid = Str::uuid();
        $terminal->title = $this->title;
        $terminal->callback_url = $this->callback_url;
        $terminal->password = $this->password;
        $terminal->save();

        $this->emitTo(\App\Http\Livewire\Panel\Terminal\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.created'));

    }

    public function render()
    {
        return view('livewire.panel.terminal.create');
    }
}
