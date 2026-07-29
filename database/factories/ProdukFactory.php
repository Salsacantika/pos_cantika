<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'foto' => 'produk/' . fake()->uuid() . '.jpg',
            'nama' => fake()->word(),
            'harga_beli' => fake()->numberBetween(5000, 10000),
            'harga_jual' => fake()->numberBetween(10000, 20000),
            'stok' => fake()->numberBetween(1, 100),
        ];
    }
}