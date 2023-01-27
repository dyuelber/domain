<?php

namespace Tests\Feature\Users;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TokenTest extends TestCase
{
    protected $user;
    protected $accessToken;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $token = $this->user->createToken($this->user->email, ['basic-user']);

        $this->accessToken = $token->plainTextToken;

        Sanctum::actingAs($this->user, ['basic-user']);
    }

    /**
     * @test
     */
    public function must_return_token_abilities_system()
    {
        $response = $this->getJson('api/v1/abilities');
        $response->assertStatus(200);

        $this->assertArrayHasKey('abilities', data_get($response, 'original.response'));
    }

    /**
     * @test
     */
    public function must_update_abilities_token_successfull()
    {
        $data = ['abilities' => config('sanctum.abilities')];

        $response = $this->putJson('api/v1/abilities/'.$this->accessToken, $data);
        $response->assertStatus(200);
    }
}
