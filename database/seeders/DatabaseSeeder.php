<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $adminRole = Role::create(['name' => 'admin']);
        // $userRole = Role::create(['name' => 'user']);

        $user = User::create([
            'name' => "admin",
            'email' => "admin@domain.net",
            'password' => Hash::make("mypassword123"),
            'phone' => '7783283347',
            'country_code' => '123',
            'birthday' => '1992-02-02 00:00:00',
            'user_image' => '',
            'role' => 'admin'
        ]);
        // $user->assignRole('admin');
    }
}
