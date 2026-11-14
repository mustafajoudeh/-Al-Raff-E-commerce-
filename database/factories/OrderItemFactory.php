<?php

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Order;
use App\Models\Product;

/**
 * @extends Factory<OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),

            'seller_id' => function (array $attributes) {
                return Product::find($attributes['product_id'])?->seller_id;
            },

            'quantity' => fake()->numberBetween(1, 4),

            'unit_price' => function (array $attributes) {
                $price = Product::find($attributes['product_id'])?->price ?? 15;
                return (int) round($price);
            },
        ];
    }
}