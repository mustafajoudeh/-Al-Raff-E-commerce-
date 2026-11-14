<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;


class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::all();
        $products = Product::all();

        if ($orders->isEmpty() || $products->isEmpty()) {
            return;
        }

        foreach ($orders as $order) {

            $randomProducts = $products->random(rand(1, min(4, $products->count())));

            $orderTotal = 0;

            foreach ($randomProducts as $product) {
                $quantity = rand(1, 3);
                $unitPrice = (int) round($product->price);

                OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'seller_id' => $product->seller_id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                ]);

                $orderTotal += ($quantity * $unitPrice);
            }

            $order->update([
                'total_price' => $orderTotal,
            ]);
        }
    }
}