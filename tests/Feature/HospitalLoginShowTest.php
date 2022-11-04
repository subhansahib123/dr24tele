<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HospitalLoginShowTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_front_end_hospital_log_in()
    {
        $response = $this->get(route('hospital.login'));
        $response->assertStatus(200);
    }
}
