<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $users = User::where('role', 'user')->get();
        $products = Product::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            return;
        }

        $statuses = ['pending', 'processing', 'shipped', 'delivered'];
        $paymentStatuses = ['pending', 'paid'];

        foreach (range(1, 20) as $i) {
            $user = $users->random();
            $status = $statuses[array_rand($statuses)];
            $paymentStatus = $paymentStatuses[array_rand($paymentStatuses)];

            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => $user->id,
                'subtotal' => 0,
                'tax' => 0,
                'shipping' => 5.99,
                'total' => 0,
                'status' => $status,
                'payment_method' => 'credit_card',
                'payment_status' => $paymentStatus,
                'shipping_address' => $user->formatted_address ?: '123 Sample Street, Tokyo, 101-0021',
                'billing_address' => $user->formatted_address ?: '123 Sample Street, Tokyo, 101-0021',
                'customer_notes' => $i % 3 == 0 ? 'Please handle with care' : null,
                'tracking_number' => $status === 'shipped' || $status === 'delivered' ? 'TRK' . str_pad($i, 6, '0', STR_PAD_LEFT) : null,
                'shipped_at' => $status === 'shipped' || $status === 'delivered' ? now()->subDays(rand(1, 30)) : null,
                'delivered_at' => $status === 'delivered' ? now()->subDays(rand(1, 15)) : null,
                'created_at' => now()->subDays(rand(1, 90))
            ]);

            // Add order items
            $orderItems = [];
            $subtotal = 0;

            foreach (range(1, rand(1, 4)) as $j) {
                $product = $products->random();
                $quantity = rand(1, 3);
                $unitPrice = $product->price;
                $totalPrice = $quantity * $unitPrice;

                $orderItems[] = [
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'total_price' => $totalPrice,
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                $subtotal += $totalPrice;
            }

            // Calculate totals
            $tax = $subtotal * 0.1; // 10% tax
            $total = $subtotal + $tax + $order->shipping;

            // Update order totals
            $order->update([
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total
            ]);

            // Insert order items
            OrderItem::insert($orderItems);
        }
    }
}