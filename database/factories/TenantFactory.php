<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TenantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'lastname' => fake()->lastName,
            'firstname' => fake()->firstName,
            'login' => fake()->unique()->name,
            'email' => fake()->unique()->email(),
            'phone_number' => fake()->unique()->phoneNumber,
        ];
    }
}
