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
        return [
            'user_id'           => User::factory(),
            'name'              => $this->faker->word,
            'description'       => $this->faker->sentence,
            'price_per_hour'    => $this->faker->randomFloat(2, 1, 100),
            'price_per_day'     => $this->faker->randomFloat(2, 1, 100),
            'price_per_month'   => $this->faker->randomFloat(2, 1, 100),
            'status'            => $this->faker->randomElement(['available', 'reserved', 'maintenance']),
            'rental_item_notes' => $this->faker->sentence,
        ];
    }
}
