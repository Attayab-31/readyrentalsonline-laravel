<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        // The public homepage depends on the production properties schema,
        // which is not represented by this repository's migrations.
        $response = $this->get('/up');

        $response->assertStatus(200);
    }
}
