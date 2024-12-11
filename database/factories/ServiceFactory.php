<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'direction_id'=>rand(1,10),
            'name'=>fake()->lastName(),
            'is_active'=>fake()->boolean(),
            'doctor_id'=>rand(1,10),
            'price'=>rand(10,100),
        ];
    }
}
