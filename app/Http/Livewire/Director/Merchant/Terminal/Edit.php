<?php

namespace App\Http\Livewire\Director\Merchant\Terminal;

use App\Models\Merchant;
use App\Models\Terminal;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public Terminal $Terminal;
    public Merchant $merchant;
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

    public function render()
    {
        return view('livewire.director.merchant.terminal.edit');
    }
}
