<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfereceCallTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_conference_call()
    {
        $response = $this->get(route('conference'));
        $response->assertStatus(200);
    }
}
