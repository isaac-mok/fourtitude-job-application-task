<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->numberBetween(),
            'name' => $this->faker->company(),
            'category' => $this->faker->bs(),
            'brand' => $this->faker->company(),
            'type' => $this->faker->bs(),
            'description' => $this->faker->realText(),
        ];
    }
}
