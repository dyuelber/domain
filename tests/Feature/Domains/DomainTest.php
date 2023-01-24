<?php

namespace Tests\Feature\Domains;

use Tests\TestCase;

class DomainTest extends TestCase
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
