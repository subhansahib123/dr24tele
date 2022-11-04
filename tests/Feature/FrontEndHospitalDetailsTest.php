<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FrontEndHospitalDetailsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_front_end_hospital_details()
    {
        $response = $this->get(route('home.hospital_details'));
        $response->assertStatus(200);
    }
}
