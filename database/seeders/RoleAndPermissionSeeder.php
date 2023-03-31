<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $support = Role::create(['name' => 'support']);
        $director = Role::create(['name' => 'director']);
        $store = Role::create(['name' => 'store']);
        $employee = Role::create(['name' => 'employee']);

        foreach (__('permissions') as $permission => $translate) {
            Permission::create(
                ['guard_name' => 'web', 'name' => $permission]
            );
            $admin->givePermissionTo($permission);
        }

        $user = User::findOrFail(1);
        $user->assignRole($admin);
    }
}
