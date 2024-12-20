<?php

namespace Database\Factories;

use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Worker>
 */
class WorkerFactory extends Factory
{
    protected $modal = Worker::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name'=>fake()->firstName(),
            'last_name'=>fake()->lastName(),
            'date_of_birth'=>fake()->date(),
            'gender'=>fake()->randomElement(['male' , 'female']),
            'phone_number'=>fake()->phoneNumber(),
            'address'=>fake()->address(),
            'specialization'=>fake()->jobTitle(),
            'working_hours' => fake()->time('H:i') . ' - ' . fake()->time('H:i'),
            'salary_type'=>fake()->randomElement(['fixed' , 'kpi' , 'fixed+kpi']),
            'is_active'=>fake()->boolean(),
        ];
    }
}
