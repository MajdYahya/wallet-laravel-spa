<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = Role::firstOrNew(['name' => 'user', 'guard_name' => 'web']);
        if (!$userRole->exists) {
            $userRole->fill(['name' => 'user', 'guard_name' => 'web'])->save();
        }
    }
}
