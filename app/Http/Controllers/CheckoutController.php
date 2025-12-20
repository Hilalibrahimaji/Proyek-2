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
    /**
     * Tampilkan halaman checkout
     */
    public function show()
    {
        $user = Auth::user();
        $cartItems = $user->cartItems()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        foreach ($cartItems as $item) {
            if (!$item->product->inStock() || $item->quantity > $item->product->stock) {
                return redirect()->route('cart')->with('error', 'Some items are out of stock.');
            }
        }

        $subtotal = $cartItems->sum(fn ($item) => $item->quantity * $item->product->price);
       $shipping = $subtotal >= 500000 ? 0 : 15000;
       $tax = (int) round($subtotal * 0.01);

        $total = $subtotal + $shipping + $tax;

        return view('checkout.show', compact(
            'cartItems',
            'subtotal',
            'shipping',
            'tax',
            'total'
        ));
    }

    /**
     * Proses checkout & buat Snap Token Midtrans
     */
    public function process(Request $request)
    {
        $user = Auth::user();
        $cartItems = $user->cartItems()->with('product')->get();

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
            'agree_terms' => 'required|accepted',
        ]);

        // ===== HITUNG TOTAL (RUPIAH) =====
        $subtotal = (int) round(
            $cartItems->sum(fn ($item) => $item->quantity * $item->product->price)
        );
        $shipping = $subtotal >= 500000 ? 0 : 15000;

        $tax = (int) round($subtotal * 0.01);
        $total = $subtotal + $shipping + $tax;

        // ===== BUAT ORDER =====
        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'user_id' => $user->id,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'shipping' => $shipping,
            'total' => $total,
            'status' => 'pending',
            'payment_method' => 'midtrans',
            'payment_status' => 'pending',
            'shipping_address' => $this->formatAddress($request),
            'billing_address' => $this->formatAddress($request),
        ]);

        // ===== ORDER ITEMS =====
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'unit_price' => $cartItem->product->price,
                'total_price' => $cartItem->quantity * $cartItem->product->price,
            ]);

            // Kurangi stok
            $cartItem->product->decrement('stock', $cartItem->quantity);
        }

        // ===== KONFIGURASI MIDTRANS =====
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // ===== PARAMETER MIDTRANS =====

        $itemDetails = [];

foreach ($cartItems as $item) {
    $itemDetails[] = [
        'id' => 'product-' . $item->product_id,
        'price' => (int) round($item->product->price),
        'quantity' => $item->quantity,
        'name' => $item->product->name,
    ];
}

if ($shipping > 0) {
    $itemDetails[] = [
        'id' => 'shipping',
        'price' => (int) $shipping,
        'quantity' => 1,
        'name' => 'Shipping Fee',
    ];
}

if ($tax > 0) {
    $itemDetails[] = [
        'id' => 'tax',
        'price' => (int) $tax,
        'quantity' => 1,
        'name' => 'Tax 1%',
    ];
}

      $params = [
    'transaction_details' => [
        'order_id' => $order->order_number,
        'gross_amount' => (int) $order->total,
    ],
    'customer_details' => [
        'first_name' => $request->shipping_name,
        'email' => $request->shipping_email,
        'phone' => $request->shipping_phone,
    ],
    'item_details' => $itemDetails,
];

        // ===== SNAP TOKEN =====
        $snapToken = Snap::getSnapToken($params);

        return view('checkout.payment', compact('snapToken', 'order'));
    }

    /**
     * Pembayaran sukses
     */
    public function success($orderNumber)
    {
        $order = Order::with(['user', 'orderItems.product'])
            ->where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Hapus cart user
        Auth::user()->cartItems()->delete();

        return view('checkout.success', compact('order'));
    }

    /**
     * Pembayaran gagal / dibatalkan
     */
    public function failed($orderNumber)
    {
        $order = Order::with(['user', 'orderItems.product'])
            ->where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('checkout.cancel', compact('order'));
    }

    /**
     * Format alamat
     */
    private function formatAddress(Request $request)
    {
        return "{$request->shipping_name}\n"
            . "{$request->shipping_address}\n"
            . "{$request->shipping_city}, {$request->shipping_postal_code}\n"
            . "{$request->shipping_country}\n"
            . "Phone: {$request->shipping_phone}\n"
            . "Email: {$request->shipping_email}";
    }
}
