<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LogApi>
 */
class ApiLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $method = ['GET', 'POST', 'PUT', 'DELETE'];
        $end    = microtime();

        return [
            'user_id'    => function () {
                return User::factory()->create();
            },
            'ip'         => fake()->ipv4(),
            'method'     => $method[array_rand($method)],
            'url'        => fake()->url(),
            'code'       => fake()->numberBetween(100, 500),
            'duration'   => number_format((int) $end - LARAVEL_START, 3),
            'controller' => 'controller',
            'action'     => 'action',
            'payload'    => json_encode(['n1' => fake()->name(), 'p2' => fake()->name()]),
        ];
    }
}
