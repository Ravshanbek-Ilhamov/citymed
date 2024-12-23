<?php

namespace Database\Factories;

use App\Models\Manegr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manegr>
 */
class ManegrFactory extends Factory
{
    protected $model = Manegr::class;
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
            'date_of_birth' => $this->faker->date('Y-m-d', '-20 years'),
            'phone_number' => $this->faker->phoneNumber(),
            'address' =>$this->faker->address(),
            'gender' => $this->faker->randomElement(['Male', 'Female', 'Other']),
            'salary_type' => $this->faker->randomElement(['Hourly', 'Monthly']),
            'salary' => $this->faker->numberBetween(30000, 120000),
            'email' => $this->faker->unique()->safeEmail(),
            'working_hours' => $this->faker->time('H:i:s'), // Ensure this matches the column type
            'working_days' => 'Monday-Friday', // Adjust or randomize as needed
            'profile_picture' => $this->faker->imageUrl(200, 200, 'people'),
            'role' => $this->faker->randomElement(['Manager', 'Employee', 'Intern']),
            'is_active' =>$this->faker->boolean(),  
        ];
        
    }
}
