<?php

namespace Tests\Feature\Hospital;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScheduleUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_hospital_schedule_update()
    {
        $response = $this->get(route('update.schedule'));
        $response->assertStatus(405);
    }
}
