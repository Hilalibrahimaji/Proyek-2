<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // LIST SEMUA ORDER USER
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    // DETAIL 1 ORDER + BARANGNYA
    public function show($orderNumber)
    {
        $order = Order::with('orderItems.product')
            ->where('order_number', $orderNumber)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }
    public function myOrders()
{
    $orders = Order::with('orderItems.product')
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

    return view('orders.my-orders', compact('orders'));
}



}


