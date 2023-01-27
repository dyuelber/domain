<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Tests\Request\User\UserRequest;
use Tests\TestCase;

class AccountTest extends TestCase
{
    protected UserRequest $request;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new UserRequest();

        $this->user = User::factory()->make();
    }

    /**
     * @test
     */
    public function must_create_user_successfull()
    {
        $data = $this->request->create();

        $response = $this->postJson('api/v1/accounts', $data);
        $response->assertStatus(201);
    }

    /**
     * @test
     */
    public function must_create_user_with_invalid_data_return_error()
    {
        $data = $this->request->create();

        unset($data['email']);

        $response = $this->postJson('api/v1/accounts', $data);
        $response->assertStatus(422);
    }
}
