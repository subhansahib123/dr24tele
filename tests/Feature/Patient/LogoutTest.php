<?php

namespace Tests\Feature\Patient;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_patient_logout()
    {
        $response = $this->get(route('patient.logout'));
        $response->assertStatus(302);
    }
}
