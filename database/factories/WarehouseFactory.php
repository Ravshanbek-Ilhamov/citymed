<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Warehouse>
 */
class WarehouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(), // Warehouse name
            'code' => $this->faker->unique()->bothify('WH-####'), // Unique code
            'login' => 'warehouse', // Unique username
            'password' => Hash::make('password'), // Default password
            'capacity' => $this->faker->numberBetween(500, 10000), // Random capacity
            'nurse_id' => 1, // Random nurse
            'status' => $this->faker->randomElement(['active', 'inactive']), // Random status
            'notes' => $this->faker->sentence(), // Optional notes
        ];
    }
}
