<?php

namespace Tests\Feature\Patient;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_patient_dashboard()
    {
        $response = $this->get(route('patient.dashboard'));
        $response->assertStatus(302);
    }
}
