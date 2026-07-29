<?php

namespace Database\Factories;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemPenjualanFactory extends Factory
{
    public function definition(): array
    {
        $produk = Produk::inRandomOrder()->first();

        $kuantitas = fake()->numberBetween(1, 5);

        return [
            'produk_id' => $produk->id,
            'kuantitas' => $kuantitas,
            'harga_satuan' => $produk->harga_jual,
            'subtotal' => $produk->harga_jual * $kuantitas,
        ];
    }
}