<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HealthCheckTest extends TestCase
{
    public function testHealthCheck()
    {
        $response = $this->get('/api/healthcheck');

        $response->assertStatus(200);
        $this->assertEquals(true, $this->getJsonResponse($response)->data);
    }
}
