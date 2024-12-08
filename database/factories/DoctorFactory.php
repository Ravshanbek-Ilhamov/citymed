<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
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
            'username' => $this->faker->unique()->userName,
            'password' => Hash::make('password'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'date_of_birth' => $this->faker->date('Y-m-d', '-20 years'), // Doctors at least 30 years old
            'email' => $this->faker->unique()->safeEmail,
            'phone_number' => $this->faker->unique()->phoneNumber,
            'address' => $this->faker->address,
            'specialization' => $this->faker->word,
            'years_of_experience' => $this->faker->numberBetween(1, 30),
            'per_patient_time' => $this->faker->numberBetween(10,120),
            'working_hours' => $this->faker->time('H:i') . ' - ' . $this->faker->time('H:i'),
            'is_active' => $this->faker->boolean(80), // 80% chance to be active
            'consultation_fee' => $this->faker->randomFloat(2, 50, 500), // Fees between 50 and 500
            'profile_picture' => $this->faker->imageUrl(200, 200, 'people', true, 'doctor'),
            'bio' => $this->faker->paragraph,
        ];
    }
}
