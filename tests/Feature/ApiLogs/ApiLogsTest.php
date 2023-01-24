<?php

namespace Tests\Feature\ApiLogs;

use Tests\TestCase;

class ApiLogsTest extends TestCase
{
    /**
     * @test
     */
    public function example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
