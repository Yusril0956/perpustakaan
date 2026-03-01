<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

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
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'verify' => true,
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Configure the factory to assign a random role after creating a user.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            $roles = ['admin', 'staff', 'anggota'];
            $randomRole = $roles[array_rand($roles)];
            $user->assignRole($randomRole);
        });
    }

    /**
     * Indicate that the user is unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'verify' => false,
        ]);
    }
}
