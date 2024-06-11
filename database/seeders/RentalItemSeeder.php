<?php

namespace Database\Seeders;

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

        foreach ($landlords as $landlord) {
            RentalItem::factory()->create([
                'user_id' => $landlord->id,
            ]);
        }
    }
}
