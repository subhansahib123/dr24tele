<?php

namespace Tests\Feature\Hospital;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdatePasswordTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_hospital_update_password()
    {
        $response = $this->get(route('updatePassword'));
        $response->assertStatus(302);
    }
}
