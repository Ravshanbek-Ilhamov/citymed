<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nurse>
 */
class NurseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'date_of_birth' => $this->faker->date('Y-m-d', '-20 years'),
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->unique()->phoneNumber,
            'address' => $this->faker->address,
            'working_hours' => $this->faker->time('H:i') . ' - ' . $this->faker->time('H:i'),
            'is_active' => $this->faker->boolean(80),
            'profile_picture' => $this->faker->imageUrl(200, 200, 'people', true, 'doctor'),
        ];
    }
}
