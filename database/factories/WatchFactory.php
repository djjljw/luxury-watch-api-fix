<?php

namespace Database\Factories;

use App\Models\Watch;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Watch>
 */
class WatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->randomElement(['Rolex Submariner', 'Omega Seamaster', 'Audemars Piguet Royal Oak', 'Patek Philippe Calatrava']),
            'brand' => fake()->randomElement(['Rolex', 'Omega', 'Patek Philippe', 'Audemars Piguet', 'Cartier']),
            'harga' => fake()->numberBetween(50000000, 2000000000),
            'tahun_rilis' => fake()->numberBetween(2015, 2024),
            'tipe_gerakan' => fake()->randomElement(['Automatic', 'Manual', 'Quartz']),
            'material' => fake()->randomElement(['Oystersteel', 'Gold 18k', 'Platinum', 'Titanium']),
            'status' => fake()->randomElement(['tersedia', 'terjual']),
            'foto' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30',
        ];
    }
}
