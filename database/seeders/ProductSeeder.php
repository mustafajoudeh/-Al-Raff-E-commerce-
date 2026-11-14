<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Seller;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sellers = Seller::all();

        Product::factory(15)
            ->recycle($sellers)
            ->create();
    }
}