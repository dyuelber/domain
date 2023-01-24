<?php

namespace Tests\Unit;

use App\Services\ApiLogService;
use Tests\TestCase;

class ApiLogTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->service = new ApiLogService();
    }

    /**
     * @test
     */
    public function example()
    {
        $this->assertTrue(true);
    }
}
