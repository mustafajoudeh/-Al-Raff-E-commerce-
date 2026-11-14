<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductImage;


class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            ProductImage::factory()->create([
                'product_id' => $product->id,
                'is_primary' => true,
            ]);

            ProductImage::factory(2)->create([
                'product_id' => $product->id,
                'image' => 'https://picsum.photos' . fake()->unique()->numberBetween(1, 9000) . '/400/600',
                'is_primary' => false,
            ]);
        }
    }
}