<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdmunUserSeeder::class,
        ]);
        $countries_path = './sql_data/tbl_countries.sql';
        $states_path = './sql_data/tbl_states.sql';
        $cities_path = './sql_data/tbl_cities.sql';
        \DB::unprepared(file_get_contents($countries_path));
        \DB::unprepared(file_get_contents($states_path));
        \DB::unprepared(file_get_contents($cities_path));
        $this->command->info('Country,state and city tables created and seeded!');
    }
}
