<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Models\Guest;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $users = User::all();
        $guests = Guest::all();

        // Create orders for members
        foreach ($users->take(5) as $user) {
            $this->createOrder($user, null, $products);
        }

        // Create orders for guests
        foreach ($guests->take(3) as $guest) {
            $this->createOrder(null, $guest, $products);
        }
    }

    /**
     * Create an order with items and payment
     */
    private function createOrder($user, $guest, $products)
    {
        $orderStatus = ['pending', 'preparing', 'ready', 'completed'];
        $randomStatus = $orderStatus[array_rand($orderStatus)];
        
        $order = Order::create([
            'user_id' => $user ? $user->id : null,
            'guest_id' => $guest ? $guest->id : null,
            'status' => $randomStatus,
            'total_price' => 0, // Will be updated after adding items
        ]);
    
        $totalPrice = 0;
    
        // Add 1-3 random products to the order
        $orderProducts = $products->random(rand(1, 3));
    
        foreach ($orderProducts as $product) {
            $quantity = rand(1, 3);
            $pricePerItem = $user ? $product->price_member : $product->price_regular;
            $subtotal = $pricePerItem * $quantity;
            $totalPrice += $subtotal;
            
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price_per_item' => $pricePerItem,
                'subtotal' => $subtotal,
            ]);
        }
    
        // Update the order total
        $order->update(['total_price' => $totalPrice]);
    
        // Create payment
        $paymentStatus = ['pending', 'paid'];
        $randomPaymentStatus = $paymentStatus[array_rand($paymentStatus)];
    
        $payment = Payment::create([
            'order_id' => $order->id,
            'status' => $randomPaymentStatus,
            'payment_method' => $randomPaymentStatus === 'paid' ? 'Credit Card' : null,
            'paid_at' => $randomPaymentStatus === 'paid' ? now() : null,
        ]);
    }
}
