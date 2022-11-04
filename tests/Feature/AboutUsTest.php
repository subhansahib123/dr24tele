<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AboutUsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_about_us()
    {
        $response = $this->get(route('aboutUs'));
        $response->assertStatus(200);
    }
}
