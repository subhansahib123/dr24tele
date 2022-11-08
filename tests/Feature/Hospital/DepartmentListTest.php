<?php

namespace Tests\Feature\Hospital;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DepartmentListTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_hospital_department_list()
    {
        $response = $this->get(route('hospitalDepartments.list'));
        $response->assertStatus(302);
    }
}
