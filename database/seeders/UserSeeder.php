<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->email = 'info@derak.io';
        $user->password = Hash::make('P@ssw0rd321');
        $user->email_verified_at = Carbon::now();
        $user->save();

        $user = new User();
        $user->email = 'user@derak.io';
        $user->password = Hash::make('P@ssw0rd321');
        $user->email_verified_at = Carbon::now();
        $user->save();
    }
}
