<?php

namespace Tests\Feature\Patient;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_patient_appointment()
    {
        $response = $this->get(route('appointments'));
        $response->assertStatus(302);
    }
}
