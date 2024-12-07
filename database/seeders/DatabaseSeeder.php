<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $roles = ['doctor','nurse','cashier','manager','patient','admin','registrar'];
        foreach ($roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }
        
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'username' => 'testUser',
            'role_id' => 2,
            'password' => Hash::make('12345678'),
        ]);

        User::factory()->create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@gmail.com',
            'username' => 'SuperAdmin@',
            'role_id' => 2,
            'password' => Hash::make('12345678'),
        ]);

        $this->call([
            DoctorSeeder::class,
            DirectionSeeder::class,
            ServiceSeeder::class,
        ]);

    }
}
