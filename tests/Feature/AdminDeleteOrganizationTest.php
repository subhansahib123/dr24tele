<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminDeleteOrganizationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_delete_organization()
    {
        $response = $this->get(route('delete.organisation','uuid'));
        $response->assertStatus(302);
    }
}
