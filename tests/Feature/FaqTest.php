<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FaqTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_faq()
    {
        $response = $this->get(route('faq'));
        $response->assertStatus(200);
    }
}
