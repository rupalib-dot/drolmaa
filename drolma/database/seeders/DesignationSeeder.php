<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Designation;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Designation::insert([
            'designation_title' => 'Project Manager',
        ]);
        Designation::insert([
            'designation_title' => 'Seniour Developer',
        ]);
        //User::factory(10)->create();

    }
}
