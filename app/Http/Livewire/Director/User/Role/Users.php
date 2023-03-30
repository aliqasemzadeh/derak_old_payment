<?php

namespace App\Http\Livewire\Director\User\Role;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Users extends Component
{
    public  $role;

    public function mount(Role $role)
    {
        $this->role = $role;
    }

    public function render()
    {
        return view('livewire.director.user.role.users');
    }
}
