<?php

namespace Database\Factories;

use App\Models\RentalItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserve>
 */
class ReserveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = Carbon::now()->subDays($this->faker->numberBetween(1, 30));
        $end   = (clone $start)->addHours($this->faker->numberBetween(1, 12));

        return [
            'user_id'        => User::factory(),
            'title'          => $this->faker->sentence,
            'description'    => $this->faker->paragraph,
            'start'          => $start,
            'end'            => $end,
            'rental_item_id' => RentalItem::factory(),
            'status'         => $this->faker->randomElement(['pending', 'canceled', 'confirmed']),
            'price'          => $this->faker->randomFloat(2, 50, 1000),
            'payment_type'   => $this->faker->randomElement(['cartão', 'dinheiro', 'transferência', 'pix']),
        ];
    }
}
