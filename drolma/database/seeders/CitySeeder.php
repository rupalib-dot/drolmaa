<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::insert([
            'state_id' => 1,
            'city_name' => 'Geelong',
        ]);
        City::insert([
            'state_id' => 2,
            'city_name' => 'Jaipur',
        ]);
        //User::factory(10)->create();

    }
}
