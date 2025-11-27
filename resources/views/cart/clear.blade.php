@extends('layouts.main')

@section('title', 'Clear Cart - VHGH')

@section('content')
<!-- Header -->
<section class="bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Clear Shopping Cart</h1>
                <p class="text-gray-600">Confirm to remove all items from your cart</p>
            </div>
            <div class="text-sm text-gray-500">
                <a href="{{ route('home') }}" class="text-[#10a2a2] hover:text-[#0d8c8c]">Home</a> 
                <span class="mx-2">/</span> 
                <a href="{{ route('cart') }}" class="text-[#10a2a2] hover:text-[#0d8c8c]">Cart</a>
                <span class="mx-2">/</span> 
                <span class="text-gray-400">Clear Cart</span>
            </div>
        </div>
    </div>
</section>

<!-- Confirmation Section -->
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                <!-- Warning Icon -->
                <div class="text-center mb-6">
                    <div class="mx-auto w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Clear Your Cart?</h2>
                    <p class="text-gray-600">This action cannot be undone</p>
                </div>

                <!-- Cart Summary -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <div class="text-center">
                        <p class="text-gray-700 mb-2">
                            You are about to remove <span class="font-bold text-red-600">{{ $cartItemsCount }}</span> 
                            item(s) from your cart
                        </p>
                        <p class="text-lg font-bold text-gray-800">
                            Total: ${{ number_format($cartTotal, 2) }}
                        </p>
                    </div>
                </div>

                <!-- Items Preview -->
                @if($cartItems->count() > 0)
                <div class="mb-6">
                    <h3 class="font-semibold text-gray-800 mb-3">Items in your cart:</h3>
                    <div class="space-y-3 max-h-48 overflow-y-auto">
                        @foreach($cartItems as $item)
                        <div class="flex items-center space-x-3 p-2 bg-white border border-gray-200 rounded-lg">
                            <img src="{{ $item->product->image }}" 
                                 alt="{{ $item->product->name }}" 
                                 class="w-12 h-12 object-cover rounded">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800 truncate">{{ $item->product->name }}</p>
                                <p class="text-xs text-gray-600">Qty: {{ $item->quantity }} × ${{ number_format($item->product->price, 2) }}</p>
                            </div>
                            <span class="text-sm font-bold text-gray-800">
                                ${{ number_format($item->product->price * $item->quantity, 2) }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Confirmation Buttons -->
                <div class="space-y-4">
                    <form action="{{ route('cart.clear.confirm') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full bg-red-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-red-700 transition duration-300 transform hover:scale-105 flex items-center justify-center">
                            <i class="fas fa-trash mr-2"></i>
                            Yes, Clear My Cart
                        </button>
                    </form>

                    <a href="{{ route('cart') }}" 
                       class="w-full bg-gray-800 text-white py-3 px-4 rounded-lg font-semibold hover:bg-gray-900 transition duration-300 flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        No, Keep My Items
                    </a>
                </div>

                <!-- Additional Info -->
                <div class="mt-6 text-center text-sm text-gray-500">
                    <p>Your cart items will be permanently removed and you'll need to add them again.</p>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-6 text-center">
                <p class="text-gray-600 mb-4">Or you can:</p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('products') }}" 
                       class="inline-flex items-center px-4 py-2 bg-[#10a2a2] text-white rounded-lg hover:bg-[#0d8c8c] transition duration-300">
                        <i class="fas fa-shopping-bag mr-2"></i>
                        Continue Shopping
                    </a>
                    <a href="{{ route('checkout') }}" 
                       class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300">
                        <i class="fas fa-credit-card mr-2"></i>
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Custom scrollbar for items preview */
    .max-h-48::-webkit-scrollbar {
        width: 6px;
    }
    .max-h-48::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 3px;
    }
    .max-h-48::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }
    .max-h-48::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
</style>
@endpush