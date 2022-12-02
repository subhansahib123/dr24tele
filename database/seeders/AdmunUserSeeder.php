<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User_Role;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profession;
use Illuminate\Support\Str;

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
        $roles =[
            ['EHRNAdmin','ehrnadmin'],
            ['FrontOffice','frontoffice'],
            ['OrgSuperAdmin','orgsuperadmin'],
            ['Practitioner','practitioner'],
        ];
        foreach ($roles as $role) {
            Role::create(['name' => $role['0'],'slug'=>$role[1]]);
        }
        $users = [
            ['nissi','nissi@drtele.co','9715555555',bcrypt('nissi@drtele'),1,1,now(),Str::uuid()],
            ['akhil','akhil@drtele.co','97155555525',bcrypt('akhil@drtele'),1,1,now(),Str::uuid()],
        ];
        foreach ($users as $user) {
            $details = User::create([
                'username' => $user[0],
                'email'=>$user[1],
                'phone_number'=>$user[2],
                'password'=>$user[3],
                'profession_id'=>$user[4],
                'status'=>$user[5],
                'email_verified_at'=>$user[6],
                'uuid'=>$user[7]
            ]);
            User_Role::create([
                'user_id' => $details->id,
                'role_id' => 1
            ]);
        }
        $countries_path = './sql_data/tbl_countries.sql';
        $states_path = './sql_data/tbl_states.sql';
        $cities_path = './sql_data/tbl_cities.sql';
        \DB::unprepared(file_get_contents($countries_path));
        \DB::unprepared(file_get_contents($states_path));
        \DB::unprepared(file_get_contents($cities_path));
        $this->command->info('Country,state and city tables created and seeded!');

    }
}
