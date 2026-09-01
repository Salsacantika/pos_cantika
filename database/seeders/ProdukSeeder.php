<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;  

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::factory()->count(20)->create();
    }
}
