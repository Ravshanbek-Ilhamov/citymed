<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registrator>
 */
class RegistratorFactory extends Factory
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
            'username' => $this->faker->unique()->userName(),
            'password' => Hash::make('password'), // Default password
            'gender' => $this->faker->randomElement(['male', 'female']),
            'date_of_birth' => $this->faker->date('Y-m-d', '2005-01-01'), // Example: Adult registrators
            'email' => $this->faker->email(),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'working_hours' => '9:00-16:00', // Example: 4-12 hours/day
            'is_active' => $this->faker->boolean(),
            'bio' => $this->faker->paragraph(),
            'working_days' => implode(',', $this->faker->randomElements(
                ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                $this->faker->numberBetween(3, 6)
            )),
            'salary_type' => $this->faker->randomElement(['kpi', 'kpi+fixed', 'fixed']),
        ];
    }
}
