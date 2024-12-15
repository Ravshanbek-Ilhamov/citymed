<?php

namespace Database\Seeders;

use App\Models\Nurse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NurseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Nurse::factory()->count(30)->create();
    }
}
