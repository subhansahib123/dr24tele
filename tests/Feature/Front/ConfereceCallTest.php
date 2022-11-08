<?php

namespace Tests\Feature\Front;

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
        $response = $this->get('/conference/call');
        $response->assertStatus(500);
    }
}
