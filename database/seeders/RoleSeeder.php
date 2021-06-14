<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            'role_name' => 'Admin',
        ]);
        Role::insert([
            'role_name' => 'Expert',
        ]);
        Role::insert([
            'role_name' => 'Customer',
        ]);
        //User::factory(10)->create();

    }
}
