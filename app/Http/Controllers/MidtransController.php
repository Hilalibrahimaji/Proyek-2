<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        $payload = $request->all();

        $orderNumber = $payload['order_id'];
        $transactionStatus = $payload['transaction_status'];
        $paymentType = $payload['payment_type'];
        $fraudStatus = $payload['fraud_status'] ?? null;

        $order = Order::where('order_number', $orderNumber)->first();
        if (!$order) return response()->json(['message' => 'Order not found']);

        // ===== LOGIKA STATUS =====
        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            $order->update([
                'payment_status' => 'paid',
                'status' => 'processing',
                'payment_method' => $paymentType
            ]);
        } elseif ($transactionStatus == 'pending') {
            $order->update([
                'payment_status' => 'pending'
            ]);
        } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
            $order->update([
                'payment_status' => 'failed',
                'status' => 'cancelled'
            ]);
        }

        return response()->json(['message' => 'OK']);
    }
}
