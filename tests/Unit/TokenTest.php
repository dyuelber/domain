<?php

namespace Tests\Unit;

use App\Exceptions\MissingParameterException;
use App\Models\User;
use App\Services\UserService;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TokenTest extends TestCase
{
    protected UserService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new UserService();
    }

    /**
     * @test
     */
    public function create_user_and_token_succesfull()
    {
        $email = fake()->email();
        $user = $this->service->create([
            'email' => $email,
            'password' => '123456',
            'abilities' => config('sanctum.abilities'),
        ]);

        $this->assertDatabaseHas('users', [
            'email' => $email,
        ]);

        $this->assertDatabaseHas('personal_access_tokens', [
            'tokenable_id' => $user->id,
        ]);
    }

    /**
     * @test
     */
    public function should_error_create_user_and_token()
    {
        $this->expectException(MissingParameterException::class);

        $this->service->create([
            'email' => null,
            'password' => '123456',
            'abilities' => config('sanctum.abilities'),
        ]);
    }

    public function setUpUpdateAbilities(): User
    {
        $user = User::factory()->create();

        $abilities = ['create-domain', 'update-domain'];

        $user->createToken($user->email, $abilities, today()->addMonth());

        Sanctum::actingAs($user, $abilities);

        return $user;
    }

    /**
     * @test
     */
    public function update_user_and_token_succesfull()
    {
        $user = $this->setUpUpdateAbilities();

        $updated = $this->service->updateAbilities([
            'abilities' => config('sanctum.abilities'),
        ], '');

        $this->assertEquals(config('sanctum.abilities'), $updated->abilities);

        $this->assertDatabaseHas('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'expires_at' => today()->addYear(),
        ]);
    }

    /**
     * @test
     */
    public function should_error_update_user_and_token()
    {
        $this->expectException(MissingParameterException::class);

        $this->setUpUpdateAbilities();

        $this->service->updateAbilities([
            'abilities' => null,
        ], '');
    }
}
