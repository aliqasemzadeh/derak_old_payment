<?php

namespace App\Http\Livewire\Director\User\Role;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    use LivewireAlert;
    public $name;

    public function create()
    {
        if(!auth()->user()->can('admin_roles_create')) {
            return abort(403);
        }

        $this->validate([
            'name' => 'required|string'
        ]);

        Role::create(['name' => $this->name]);

        $this->emitTo(\App\Http\Livewire\Director\User\Role\Index::getName(), 'updateList');
        $this->emit('hideModal');

        $this->alert('success', __('bap.created'));
    }


    public function render()
    {
        if(!auth()->user()->can('admin_roles_create')) {
            return abort(403);
        }

        return view('livewire.director.user.role.create');
    }
}
