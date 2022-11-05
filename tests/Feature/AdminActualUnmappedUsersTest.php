<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminActualUnmappedUsersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_actual_unmapped_users()
    {
        $response = $this->get(route('users.unmapped.actual'));
        $response->assertStatus(302);
    }
}
