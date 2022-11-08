<?php

namespace Tests\Feature\Front;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FrontEndDepartmentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_front_end_department()
    {
        $response = $this->get(route('home.getAllDepartments'));
        $response->assertStatus(200);
    }
}
