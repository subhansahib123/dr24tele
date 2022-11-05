<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminUpdateUserRoleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_update_user_role_store()
    {
        $response = $this->get(route('updatingRole','uuid'));
        $response->assertStatus(405);
    }
}
