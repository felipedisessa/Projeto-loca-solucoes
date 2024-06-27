<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'  => 'Admin Users',
            'email' => 'admin@admin.com',
            'role'  => 'admin',
        ]);

        User::factory()->count(4)->create([
            'role' => 'landlord',
        ]);

        User::factory(10)->create();

        $this->call([
            RentalItemSeeder::class,
            ReserveSeeder::class,
        ]);
    }
}
