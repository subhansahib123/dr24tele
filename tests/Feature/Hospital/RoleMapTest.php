<?php

namespace Tests\Feature\Hospital;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoleMapTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_hospital_map_role()
    {
        $response = $this->get(route('mapHospital.user'));
        $response->assertStatus(302);
    }
}
