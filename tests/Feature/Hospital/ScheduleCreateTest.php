<?php

namespace Tests\Feature\Hospital;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScheduleCreateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_hospital_schedule_create()
    {
        $response = $this->get(route('create.schedule'));
        $response->assertStatus(302);
    }
}
