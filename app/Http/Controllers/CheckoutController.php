<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $cartItems = $user->CartItem()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        foreach ($cartItems as $item) {
            if (!$item->product->inStock() || $item->quantity > $item->product->stock) {
                return redirect()->route('cart')->with('error', 'Some items are out of stock.');
            }
        }

        $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);
        $shipping = $subtotal > 50 ? 0 : 5.99;
        $tax = $subtotal * 0.1;
        $total = $subtotal + $shipping + $tax;

        return view('checkout.show', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function process(Request $request)
    {
        $user = Auth::user();
        $cartItems = $user->CartItem()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_email' => 'required|email',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:100',
            'shipping_postal_code' => 'required|string|max:20',
            'shipping_country' => 'required|string|max:100',
            'agree_terms' => 'required|accepted'
        ]);

        $subtotal = (int) round($cartItems->sum(fn($item) => $item->quantity * $item->product->price));
$shipping = ($subtotal > 50000) ? 0 : 5999; // sesuaikan dalam rupiah, bukan 5.99
$tax = (int) round($subtotal * 0.1);
$total = (int) ($subtotal + $shipping + $tax);


        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'user_id' => $user->id,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => $total,
            'status' => 'pending',
            'payment_status' => 'pending',
            'shipping_address' => $this->formatAddress($request),
            'billing_address' => $this->formatAddress($request),
        ]);

        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'unit_price' => $cartItem->product->price,
                'total_price' => $cartItem->quantity * $cartItem->product->price
            ]);

            $cartItem->product->decrement('stock', $cartItem->quantity);
        }


        // === Integrasi Midtrans Snap ===
        // === Integrasi Midtrans Snap ===
    \Midtrans\Config::$serverKey = config('midtrans.serverKey');
    \Midtrans\Config::$isProduction = config('midtrans.isProduction');
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;


        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => (int)$order->total,
            ],
            'customer_details' => [
                'first_name' => $request->shipping_name,
                'email' => $request->shipping_email,
                'phone' => $request->shipping_phone,
            ],
            'item_details' => $cartItems->map(function ($item) {
    return [
        'id' => $item->product_id,
        'price' => (int) round($item->product->price),
        'quantity' => $item->quantity,
        'name' => $item->product->name,
    ];
})->toArray(),

        ];

        $snapToken = Snap::getSnapToken($params);

        return view('checkout.payment', compact('snapToken', 'order'));
    }

    private function formatAddress(Request $request)
    {
        return "{$request->shipping_name}\n{$request->shipping_address}\n{$request->shipping_city}, {$request->shipping_postal_code}\n{$request->shipping_country}\nPhone: {$request->shipping_phone}\nEmail: {$request->shipping_email}";
    }

    public function success($orderId)
{
    $order = Order::with(['user', 'orderItems.product'])
        ->where('id', $orderId)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    // ✅ Hapus cart setelah pembayaran sukses
    Auth::user()->CartItem()->delete();

    return view('checkout.success', compact('order'));
}


    public function failed($orderId)
    {
        $order = Order::with(['user', 'orderItems.product'])
            ->where('id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('checkout.cancel', compact('order'));
    }
}
