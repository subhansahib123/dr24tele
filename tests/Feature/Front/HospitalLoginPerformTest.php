<?php

namespace Tests\Feature\Front;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HospitalLoginPerformTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_front_end_hospital_logged_in()
    {
        $response = $this->get(route('hospital.loggedin',1));
        $response->assertStatus(500);
    }
}
