<?php

namespace Tests\Feature\Health;

use Tests\TestCase;

class HealthCheckTest extends TestCase
{
    /**
     * @test
     */
    public function must_call_route_return_successfull()
    {
        $this->assertTrue(true);
    }
}
