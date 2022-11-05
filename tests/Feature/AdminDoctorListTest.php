<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminDoctorListTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_doctor_list()
    {
        $response = $this->get(route('doctors.list','uuid'));
        $response->assertStatus(302);
    }
}
