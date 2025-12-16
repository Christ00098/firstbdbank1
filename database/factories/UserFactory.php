<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // default password
            'remember_token' => Str::random(10),
            'account_type' => $this->faker->randomElement(['savings', 'current']),
            'account_name' => $this->faker->company(),
            'account_number' => $this->faker->unique()->bankAccountNumber(),
            'balance' => $this->faker->randomFloat(2, 0, 10000),
            'credit' => $this->faker->randomFloat(2, 0, 5000),
            'debit' => $this->faker->randomFloat(2, 0, 5000),
            'last_transaction_amount' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
