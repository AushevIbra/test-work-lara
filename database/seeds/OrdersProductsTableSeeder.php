<?php

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrdersProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $limit = 1000;

        $products = Product::get();
        $orders = Order::get();

        for ($orderId = 1; $orderId <= $limit; $orderId++) {
            $pLimit = rand(1, 4);
            $order = $orders->where('id', $orderId)->first();

            for ($productsOrderCnt = 1; $productsOrderCnt <= $pLimit; $productsOrderCnt++) {
                $product = $products->random();
                $createdAt = \Carbon\Carbon::now()->subDays(rand(0, 4));
                DB::table('order_products')->insert([
                    'order_id' => $orderId,
                    'product_id' => $product->id,
                    'quantity' => rand(1, 3),
                    'price' => $product->price,
                    'created_at' => $order->created_at,
                    'updated_at' => $order->updated_at,
                    'delivery_dt' => $createdAt->copy()->addHours(rand(6,50)),
                ]);
            }
        }
    }
}
