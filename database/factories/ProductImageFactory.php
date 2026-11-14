<?php

namespace Database\Factories;

use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;


/**
 * @extends Factory<ProductImage>
 */
class ProductImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'image' => function (array $attributes) {
                $product = Product::find($attributes['product_id']);
                $isbn = $product?->isbn;


                return $isbn
                    ? "https://openlibrary.org{$isbn}-L.jpg?default=false"
                    : "https://picsum.photos" . fake()->numberBetween(1, 5000) . "/400/600";
            },
            'is_primary' => false,
        ];
    }
}