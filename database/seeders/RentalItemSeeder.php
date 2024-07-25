<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\RentalItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class RentalItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $landlords = User::query()->where('role', 'landlord')->get();

        // Salas específicas
        $rentalItemNames = ['Sala de Reunião', 'Sala 01', 'Sala 02'];

        // Endereço fixo para o CEP "14701-150"
        $fixedAddress = [
            'street'       => 'Nossa Sra. de Fátima',
            'number'       => '350',
            'complement'   => '',
            'neighborhood' => 'Centro',
            'city'         => 'Bebedouro',
            'state'        => 'SP',
            'zipcode'      => '14701150',
            'country'      => 'Brasil',
        ];

        foreach ($rentalItemNames as $index => $name) {
            $landlord = $landlords[$index];

            $rentalItem = RentalItem::factory()->create([
                'user_id' => $landlord->id,
                'name'    => $name,
            ]);

            Address::create(array_merge($fixedAddress, ['rental_item_id' => $rentalItem->id]));
        }
    }
}
