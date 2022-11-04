<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PrivacyPolicyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_patient_privacy_policy_page()
    {
        $response = $this->get(route('privacyPolicy'));
        $response->assertStatus(200);
    }
}
