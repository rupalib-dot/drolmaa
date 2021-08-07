<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        State::insert([
            'country_id' => 1,
            'state_name' => 'VIC',
        ]);
        State::insert([
            'country_id' => 2,
            'state_name' => 'Rajasthan',
        ]);
        //User::factory(10)->create();

    }
}
