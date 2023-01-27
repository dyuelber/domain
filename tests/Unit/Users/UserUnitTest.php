<?php

namespace Tests\Unit;

use App\Domains\Abstracts\Services\AbstractService;
use App\Domains\Users\Services\UserService;
use App\Exceptions\MissingParameterException;
use App\Models\User;
use Tests\TestCase;

class UserUnitTest extends TestCase
{
    protected AbstractService $service;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = app(UserService::class);
        $this->user    = User::factory()->make();
    }

    /**
     * @test
     */
    public function must_create_user_successfull()
    {
        $data = $this->user->toArray();

        $data['password'] = 'password';

        $this->service->create($data);

        $this->assertDatabaseHas('users', [
            'name'  => $data['name'],
            'email' => $data['email'],
        ]);
    }

    /**
     * @test
     */
    public function must_create_user_with_invalid_data()
    {
        $this->expectException(MissingParameterException::class);

        $data = $this->user->toArray();

        $data['email'] = null;

        $this->service->create($data);
    }
}
