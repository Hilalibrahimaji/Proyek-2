@extends('layouts.main')

@section('title', 'Order Detail')

@section('content')
<div class="container mx-auto px-4 py-8">

    <!-- Header -->
    <div class="bg-[#10a2a2] text-white rounded-lg p-6 mb-6">
        <h1 class="text-2xl font-bold">Detail Pesanan</h1>
        <p class="text-sm opacity-90">
            Order #{{ $order->order_number }} •
            {{ $order->created_at->format('d M Y, H:i') }}
        </p>
    </div>

    <!-- Order Info -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

        <!-- Left -->
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <h2 class="font-semibold text-gray-800 mb-4">Informasi Pesanan</h2>

            <table class="w-full text-sm">
                <tr class="border-b">
                    <td class="py-2 text-gray-600">Status Order</td>
                    <td class="py-2 text-right">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $order->status_badge }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </td>
                </tr>
                <tr class="border-b">
                    <td class="py-2 text-gray-600">Status Pembayaran</td>
                    <td class="py-2 text-right">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $order->payment_status_badge }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="py-2 text-gray-600">Metode Pembayaran</td>
                    <td class="py-2 text-right font-medium">
                        {{ strtoupper($order->payment_method) }}
                    </td>
                </tr>
            </table>
        </div>

        <!-- Right -->
        <div class="bg-white rounded-lg shadow-sm border p-6">
            <h2 class="font-semibold text-gray-800 ">Alamat Pengiriman</h2>
            <p class="text-sm text-gray-600 whitespace-pre-line">
                {{ $order->shipping_address }}
            </p>

            @if($order->tracking_number)
                <div class="mt-4 text-sm">
                    <span class="font-semibold text-gray-800">Resi:</span>
                    <span class="text-[#10a2a2] font-medium">
                        {{ $order->tracking_number }}
                    </span>
                </div>
            @endif
        </div>

    </div>

    <!-- Product Table -->
    <div class="bg-white rounded-lg shadow-sm border mb-8">
        <div class="p-6 border-b">
            <h2 class="font-semibold text-gray-800">Produk yang Dipesan</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left">Produk</th>
                        <th class="px-6 py-3 text-center">Qty</th>
                        <th class="px-6 py-3 text-right">Harga</th>
                        <th class="px-6 py-3 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($order->orderItems as $item)
                        <tr>
                            <td class="px-6 py-4 flex items-center space-x-3">
    <img
    src="{{ $item->product->image }}"
    class="w-12 h-12 rounded object-cover border"
>

                                <span class="font-medium text-gray-800">
                                    {{ $item->product->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                Rp {{ number_format($item->unit_price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-right font-semibold">
                                Rp {{ number_format($item->total_price, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Summary -->
    <div class="flex justify-end">
        <div class="w-full md:w-1/3 bg-white rounded-lg shadow-sm border p-6">
            <h2 class="font-semibold text-gray-800 mb-4">Ringkasan Pembayaran</h2>

            <table class="w-full text-sm">
                <tr>
                    <td class="py-2 text-gray-600">Subtotal</td>
                    <td class="py-2 text-right">
                        Rp {{ number_format($order->subtotal, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td class="py-2 text-gray-600">Pajak</td>
                    <td class="py-2 text-right">
                        Rp {{ number_format($order->tax, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td class="py-2 text-gray-600">Pengiriman</td>
                    <td class="py-2 text-right">
                        Rp {{ number_format($order->shipping, 0, ',', '.') }}
                    </td>
                </tr>
                <tr class="border-t font-semibold">
                    <td class="py-3">Total</td>
                    <td class="py-3 text-right text-[#10a2a2] text-lg">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Back Button -->
                <div class="mt-8">
        
        <a href="{{ route('home') }}" 
            class="bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-900 transition duration-300">
            ← Home
        </a>
    </div>

    <div class="mt-8">
        
        <a href="{{ route('my.orders') }}" 
            class="bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-900 transition duration-300">
            ← My Orders
        </a>
    </div>



    

</div>
@endsection
