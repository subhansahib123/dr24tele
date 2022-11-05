<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminDepartmentSingleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_admin_department_single_patient()
    {
        $response = $this->get(route('single.department','uuid'));
        $response->assertStatus(302);
    }
}
