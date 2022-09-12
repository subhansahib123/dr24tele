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

    }
}
