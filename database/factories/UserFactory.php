<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'mobile' => $this->faker->phoneNumber,
            'password' => 'password',
            'is_superuser' => $this->faker->boolean,
            'is_staff' => $this->faker->boolean,
            'profile_photo_path' => $this->faker->image,
        ];
    }

    public function superUser(): static
    {
        return $this->state(function (array $attr) {
            return [
                'is_superuser' => true,
                'is_staff' => false,
            ];
        });
    }

    public function staff(): static
    {
        return $this->state(function (array $attr) {
            return [
                'is_superuser' => false,
                'is_staff' => true,
            ];
        });
    }

    public function notAdmin(): static
    {
        return $this->state(function (array $attr) {
            return [
                'is_superuser' => false,
                'is_staff' => false,
            ];
        });
    }
}
