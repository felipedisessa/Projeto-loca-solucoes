<?php

namespace Database\Seeders;

use App\Models\RentalItem;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReserveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants     = User::query()->where('role', 'tenant')->get();
        $rentalItems = RentalItem::all();

        foreach ($tenants as $index => $tenant) {
            Reserve::factory()->create([
                'user_id'        => $tenant->id,
                'rental_item_id' => $rentalItems[$index]->id,
            ]);
        }
    }
}
