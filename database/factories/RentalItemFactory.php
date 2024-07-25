<?php

namespace Database\Factories;

use App\Models\RentalItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RentalItem>
 */
class RentalItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $statuses = [
            'available', 'reserved', 'maintenance',
        ];

        return [
            'user_id'           => User::factory(),
            'name'              => $this->faker->company . ' Sala de Reuniões',
            'description'       => $this->faker->sentence,
            'price_per_hour'    => $this->faker->randomFloat(2, 10, 50),
            'price_per_day'     => $this->faker->randomFloat(2, 100, 500),
            'price_per_month'   => $this->faker->randomFloat(2, 1000, 5000),
            'status'            => $this->faker->randomElement($statuses),
            'rental_item_notes' => $this->faker->sentence,
        ];
    }
}
