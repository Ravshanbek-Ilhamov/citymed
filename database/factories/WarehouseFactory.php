<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'name' => $this->faker->company() . ' Warehouse', // Generate a warehouse name
            'code' => $this->faker->unique()->bothify('WH-###'), // Generate a unique warehouse code
            'address' => $this->faker->address(), // Generate a fake address
            'capacity' => $this->faker->numberBetween(500, 10000), // Random capacity value
            'current_usage' => $this->faker->numberBetween(0, 5000), // Current usage within capacity
            'manager_name' => $this->faker->name(), // Random manager name
            'manager_contact' => $this->faker->unique()->phoneNumber(), // Unique phone number
            'status' => $this->faker->randomElement(['active', 'inactive', 'under_maintenance']), // Random status
            'temperature_control' => $this->faker->boolean(), // True or false for temperature control
            'security_level' => $this->faker->randomElement(['low', 'medium', 'high']), // Random security level
            'special_features' => $this->faker->optional()->sentence(), // Random optional features
            'notes' => $this->faker->optional()->paragraph(), // Optional notes
        ];
    }
}
