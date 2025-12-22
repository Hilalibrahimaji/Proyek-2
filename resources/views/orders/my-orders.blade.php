@extends('layouts.main')

@section('title', 'My Orders')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">My Orders</h1>

    @forelse($orders as $order)
        <div class="bg-white rounded-lg shadow-sm border mb-6">
            
            {{-- HEADER ORDER --}}
<div class="p-4 border-b flex justify-between items-center">

    <!-- KIRI -->
    <div>
        <div class="flex items-center space-x-3">
            <p class="font-semibold">
                Order #{{ $order->order_number }}
            </p>

            <span class="px-3 py-1 rounded text-xs {{ $order->payment_status_badge }}">
                {{ ucfirst($order->payment_status) }}
            </span>
        </div>

        <p class="text-sm text-gray-500 mt-1">
            {{ $order->created_at->format('d M Y') }}
        </p>
    </div>

    <!-- KANAN -->
    <a href="{{ route('my.orders.show', $order->order_number) }}"
       class="bg-gray-800 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-900 transition">
        View Detail
    </a>

</div>


            {{-- LIST PRODUCT --}}
            <div class="p-4">
                @foreach($order->orderItems as $item)
                    <div class="flex items-center justify-between border-b py-3 gap-4">
                        
                        {{-- FOTO + INFO PRODUK --}}
                        <div class="flex items-center gap-4">
                        <img
                        src="{{ $item->product->image }}"
                         class="w-12 h-12 rounded object-cover border"
                        >


                            <div>
                                <p class="font-medium">{{ $item->product->name }}</p>
                                <p class="text-sm text-gray-500">
                                    Qty: {{ $item->quantity }}
                                </p>
                            </div>
                        </div>

                        {{-- HARGA --}}
                        <p class="font-semibold whitespace-nowrap">
                            Rp {{ number_format($item->total_price, 0, ',', '.') }}
                        </p>
                    </div>
                @endforeach
            </div>

            {{-- TOTAL --}}
            <div class="p-4 text-right font-bold bg-gray-50">
                Total: Rp {{ number_format($order->total, 0, ',', '.') }}
            </div>
        </div>
    @empty
        <p class="text-gray-500">You have no orders yet.</p>
    @endforelse
        <div class="mt-8">
        
        <a href="{{ route('home') }}" 
            class="bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-900 transition duration-300">
            ← Kembali Home
        </a>
    </div>
</div>

@endsection
