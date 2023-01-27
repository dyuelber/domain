<?php

namespace Tests\Unit\Users;

use App\Domains\Abstracts\Services\AbstractService;
use App\Domains\Users\Services\TokenService;
use App\Exceptions\MissingParameterException;
use App\Models\User;
use Tests\TestCase;

class TokenUnitTest extends TestCase
{
    protected $user;
    protected $accessToken;
    protected AbstractService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = app(TokenService::class);

        $this->user = User::factory()->create();

        $token = $this->user->createToken($this->user->email, ['basic-user']);

        $this->accessToken = $token->plainTextToken;
    }

    /**
     * @test
     */
    public function must_update_abilities_user_successfull()
    {
        $data = ['abilities' => ['basic-user', 'users']];

        $this->service->update($this->accessToken, $data);

        $this->assertDatabaseHas('personal_access_tokens', [
            'abilities' => json_encode($data['abilities']),
        ]);
    }

    /**
     * @test
     */
    public function must_return_error_with_invalid_fields()
    {
        $this->expectException(MissingParameterException::class);

        $this->service->update($this->accessToken, ['abilites' => '']);
    }
}
