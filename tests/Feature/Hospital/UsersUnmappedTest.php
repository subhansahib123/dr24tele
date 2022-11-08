<?php

namespace Tests\Feature\Hospital;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersUnmappedTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_hospital_unmapped_users()
    {
        $response = $this->get(route('hospitalUnmapped.Users'));
        $response->assertStatus(302);
    }
}
