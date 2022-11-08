<?php

namespace Tests\Feature\Doctor;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScheduleListTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_schedule_list()
    {
        $response = $this->get('list.schedules.doctor');
        $response->assertStatus(404);
    }
}
