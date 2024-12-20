<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cashier>
 */
class CashierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'date_of_birth' => $this->faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
            'email' => $this->faker->unique()->safeEmail(),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'working_hours' => fake()->time('H:i') . ' - ' . fake()->time('H:i'),
            'salary_type'=>fake()->randomElement(['fixed' , 'kpi' , 'fixed+kpi']),
            'profile_picture' => $this->faker->imageUrl(200, 200, 'people', true, 'doctor'),
            'working_days' => fake()->randomElement(['Mon' ,'Tue' , 'Wed']),
        ];
    }
}
