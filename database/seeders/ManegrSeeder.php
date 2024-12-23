<?php

namespace Database\Seeders;

use App\Models\Manegr;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManegrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Manegr::factory(10)->create();
    }
}
