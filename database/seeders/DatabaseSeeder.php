<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();

        function createAddress($userId, $faker)
        {
            $zipcode = str_replace('-', '', '14701-150');
            Address::create([
                'user_id'      => $userId,
                'street'       => $faker->streetName,
                'number'       => $faker->buildingNumber,
                'complement'   => $faker->secondaryAddress,
                'neighborhood' => $faker->citySuffix,
                'city'         => $faker->city,
                'state'        => $faker->state,
                'zipcode'      => $zipcode,
                'country'      => $faker->country,
            ]);
        }

        // Cria o usuário administrador
        $admin = User::factory()->create([
            'name'  => 'Admin User',
            'email' => 'admin@admin.com',
            'role'  => 'admin',
        ]);
        createAddress($admin->id, $faker);

        // Cria 3 proprietários
        $landlords = User::factory()->count(3)->create(['role' => 'landlord']);

        foreach ($landlords as $landlord) {
            createAddress($landlord->id, $faker);
        }

        // Cria 3 inquilinos
        $tenants = User::factory()->count(3)->create(['role' => 'tenant']);

        foreach ($tenants as $tenant) {
            createAddress($tenant->id, $faker);
        }

        // Chama os seeders adicionais
        $this->call([
            RentalItemSeeder::class,
            ReserveSeeder::class,
        ]);
    }
}
