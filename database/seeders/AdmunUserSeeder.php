<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profession;
class AdmunUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profession::create([
            'name'=>'MasterProfession'
        ]);
        $user = User::create([
            'username' => 'nissi',
            'email'=>'nissi@drtele.co',
            'phone_number'=>'9715555555',
            'password' => bcrypt('nissi@drtele'),
            'profession_id'=>1,
            'status'=>1
        ]);
        $user = User::create([
            'username' => 'akhil',
            'email'=>'akhil@drtele.co',
            'phone_number'=>'97155555525',
            'password' => bcrypt('akhil@drtele'),
            'profession_id'=>1,
            'status'=>1
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
