<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::insert([
            'country_name' => 'Austrila',
        ]);
        Country::insert([
            'country_name' => 'India',
        ]);
        //User::factory(10)->create();

    }
}
