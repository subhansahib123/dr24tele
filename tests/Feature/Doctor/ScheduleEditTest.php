<?php

namespace Tests\Feature\Doctor;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScheduleEditTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_doctor_schedule_edit()
    {
        $response = $this->get(route('edit.schedule.doctor','id'));
        $response->assertStatus(302);
    }
}
