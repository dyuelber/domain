<?php

namespace Tests\Feature\Users;

use Tests\TestCase;

class UserTest extends TestCase
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
