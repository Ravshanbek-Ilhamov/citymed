<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use App\Models\WarehouseMedicine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseMedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WarehouseMedicine::factory(50)->create();
    }
}
