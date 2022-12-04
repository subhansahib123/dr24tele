<?php

namespace Database\Seeders;

use App\Models\Organization;
use Illuminate\Database\Seeder;

class RootOrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Organization::create([
            'name' => 'dr-tele',
            'slug'=>'dr-tele',
            'uuid'=>'c6bc6265-e876-414a-9672-a85e09280059',
            'status' => 'Enabled',
            'level'=>'Master',
            'organization_id' => null,
            'image' => null
        ]);
    }
}
