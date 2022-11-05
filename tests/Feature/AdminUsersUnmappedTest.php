<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminUsersUnmappedTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_unmapped_users()
    {
        $response = $this->get(route('users.unmapped'));
        $response->assertStatus(405);
    }
}
