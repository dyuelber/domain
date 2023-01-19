<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Domain>
 */
class DomainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid'    => fake()->uuid(),
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'current' => fake()->domainName(),
            'old'     => fake()->domainName(),
        ];
    }
}
