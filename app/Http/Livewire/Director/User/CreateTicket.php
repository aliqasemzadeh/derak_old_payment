<?php

namespace App\Http\Livewire\Director\User;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\TicketFile;
use App\Models\TicketReplay;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateTicket extends Component
{
    use WithFileUploads;
    use LivewireAlert;

    public $user;
    public $title;
    public $category_id;
    public $body;
    public $files = [];

    public function create()
    {
        $this->validate([
            'title' => 'required|string',
            'body' => 'required|string',
            'category_id' => 'required|string',
            'files.*' => 'nullable|file|max:1024',
        ]);

        $ticket = new Ticket();
        $ticket->title = $this->title;
        $ticket->category_id = $this->category_id;
        $ticket->user_id = $this->user->id;
        $ticket->ip = request()->ip();
        $ticket->save();

        $replay = new TicketReplay();
        $replay->ticket_id = $ticket->id;
        $replay->user_id = auth()->user()->id;
        $replay->body = $this->body;
        $replay->ip = request()->ip();
        $replay->save();

        foreach ($this->files as $file) {
            $fileRecord = new TicketFile();
            $fileRecord->title = $file->getClientOriginalName();
            $fileRecord->file = $file->store('ticket_files');
            $fileRecord->ticket_id = $ticket->id;
            $fileRecord->ticket_replay_id = $replay->id;
            $fileRecord->user_id = auth()->user()->id;
            $fileRecord->save();
        }

        $this->emitTo(\App\Http\Livewire\Director\User\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.created'));

    }



    public function mount($user)
    {
        $this->user = User::findOrFail($user);
    }

    public function render()
    {
        $categories = Category::where('type', 'ticket')->get();
        return view('livewire.director.user.create-ticket', compact('categories'));
    }
}
