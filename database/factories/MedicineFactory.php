<?php

namespace Database\Factories;

use App\Models\MedicineCategory;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicine>
 */
class MedicineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word() . ' Medicine',
            'category_id' => MedicineCategory::factory(), // Creates a related category
            'description' => $this->faker->sentence(),
            'batch_number' => $this->faker->unique()->bothify('BATCH-###??'),
            'quantity_in_stock' => $this->faker->numberBetween(50, 1000),
            'minimum_stock_level' => $this->faker->numberBetween(10, 50),
            'purchase_price' => $this->faker->randomFloat(2, 5, 100),
            'selling_price' => $this->faker->randomFloat(2, 10, 200),
            'discount' => $this->faker->optional(0.3, 0)->randomFloat(2, 0, 20), // 30% chance of having a discount
            'supplier_id' => $this->faker->numberBetween(1, 10), // Creates a related supplier or null
            'manufacturer_name' => $this->faker->company(),
            'country_of_origin' => $this->faker->country(),
            'manufacture_date' => $this->faker->dateTimeBetween('-2 years', '-1 year')->format('Y-m-d'),
            'expiry_date' => $this->faker->dateTimeBetween('+6 months', '+3 years')->format('Y-m-d'),
            'storage_temperature' => $this->faker->randomElement(['2-8°C', '15-25°C', 'Below 30°C']),
            'license_number' => $this->faker->optional(0.8, null)->regexify('[A-Z]{3}-[0-9]{5}'),
            'is_prescription_required' => $this->faker->boolean(30), // 30% chance of requiring a prescription
        ];
    }
}
