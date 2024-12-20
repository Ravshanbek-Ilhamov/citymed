<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WarehouseMedicine>
 */
class WarehouseMedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'medicine_id' => rand(1, 10),
            'warehouse_id' => rand(1, 4),
            'quantity' => rand(1, 100),
            'date_added' => now(),
        ];
    }
}
