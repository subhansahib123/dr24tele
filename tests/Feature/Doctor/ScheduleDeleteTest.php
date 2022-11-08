<?php

namespace Tests\Feature\Doctor;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScheduleDeleteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_doctor_schedule_delete()
    {
        $response = $this->get(route('delete.schedule.doctor','id'));
        $response->assertStatus(302);
    }
}
