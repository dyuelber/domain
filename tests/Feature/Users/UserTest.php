<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\Request\User\UserRequest;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected UserRequest $request;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new UserRequest();

        $this->user = User::factory()->create();

        Sanctum::actingAs($this->user, ['basic-user', 'users']);
    }

    /**
     * @test
     */
    public function must_update_user_credentials_with_successfull()
    {
        $data = [
            'name'     => $this->request->faker()->name(),
            'password' => $this->request->faker()->password(),
        ];

        $response = $this->putJson('api/v1/users/'.$this->user->uuid, $data);

        $response->assertStatus(200);
    }
}
