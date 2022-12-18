<?php

namespace App\Services;

use App\Models\User;

class CreateUserApi
{
    public function handle(array $data): array
    {
        try {
            $user = User::create([
                'name' => $data['email'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);

            $expire = config('sanctum.c-expiration');

            $token = $user->createToken($data['email'], $data['abilities'], $expire);
        } catch (\Throwable $th) {
            throw $th;
        }

        return [
            'token' => $token->plainTextToken,
            'expires' => $expire->toDateTimeString(),
        ];
    }
}
