<?php

namespace Database\Factories;

use App\Models\Courier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Courier>
 */
class CourierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'level' => $this->faker->numberBetween(1, 5),
            'vehicle_type' => $this->faker->randomElement(['Motorcycle', 'Car', 'Van', 'Truck']),
            'is_active' => true,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
