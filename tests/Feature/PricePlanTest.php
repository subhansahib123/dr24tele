<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PricePlanTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_patient_pricing_plan_page()
    {
        $response = $this->get(route('pricingPlan'));
        $response->assertStatus(200);
    }
}
