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
            'name' => $this->faker->company(), // Warehouse name
            'code' => $this->faker->unique()->bothify('WH-####'), // Unique code
            'capacity' => $this->faker->numberBetween(500, 10000), // Random capacity
            'manager_name' => $this->faker->name(), // Manager name
            'manager_contact' => $this->faker->phoneNumber(), // Contact number
            'status' => $this->faker->randomElement(['active', 'inactive']), // Random status
            'notes' => $this->faker->sentence(), // Optional notes
        ];
    }
}
