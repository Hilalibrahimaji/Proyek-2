@extends('layouts.main')

@section('title', 'Shopping Cart - VHGH')

@section('content')
<!-- Cart Header -->
<section class="bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Shopping Cart</h1>
                <p class="text-gray-600">Review your items and proceed to checkout</p>
            </div>
            <div class="text-sm text-gray-500">
                <a href="{{ route('home') }}" class="text-[#10a2a2] hover:text-[#0d8c8c]">Home</a> 
                <span class="mx-2">/</span> 
                <span class="text-gray-400">Cart</span>
            </div>
        </div>
    </div>
</section>

<!-- Cart Section -->
<section class="py-12">
    <div class="container mx-auto px-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <!-- Cart Header -->
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h2 class="text-xl font-semibold text-gray-800">
                            Cart Items ({{ $cartItems->count() }})
                        </h2>
                    </div>

                    <!-- Cart Items List -->
                    <div class="divide-y divide-gray-200">
                        @forelse($cartItems as $item)
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <!-- Product Image -->
                                <div class="sm:w-24 sm:h-24 w-full h-48 shrink-0">
                                    <img src="{{ $item->product->image }}" 
                                         alt="{{ $item->product->name }}" 
                                         class="w-full h-full object-cover rounded-lg">
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                                <a href="{{ route('products.show', $item->product->id) }}" class="hover:text-[#10a2a2] transition duration-300">
                                                    {{ $item->product->name }}
                                                </a>
                                            </h3>
                                            <p class="text-[#10a2a2] font-bold text-xl mb-2">
                                                ${{ number_format($item->product->price, 2) }}
                                            </p>
                                            <p class="text-sm text-gray-600 mb-4">
                                                @if($item->product->inStock())
                                                    <span class="text-green-600">{{ $item->product->stock }} items available</span>
                                                @else
                                                    <span class="text-red-600">Out of stock</span>
                                                @endif
                                            </p>
                                        </div>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="item_id" value="{{ $item->id }}">
                                            <button type="submit" class="text-gray-400 hover:text-red-500 transition duration-300">
                                                <i class="fas fa-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Quantity Controls -->
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <span class="text-gray-700 font-medium">Quantity:</span>
                                            <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                                @csrf
                                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                <div class="flex items-center border border-gray-300 rounded-lg">
                                                    <button type="button" class="px-3 py-1 text-gray-600 hover:text-gray-800 quantity-decrease"
                                                            onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})">
                                                        <i class="fas fa-minus text-sm"></i>
                                                    </button>
                                                    <span class="px-4 py-1 text-gray-800 font-medium quantity-display-{{ $item->id }}">
                                                        {{ $item->quantity }}
                                                    </span>
                                                    <button type="button" class="px-3 py-1 text-gray-600 hover:text-gray-800 quantity-increase"
                                                            onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})"
                                                            {{ $item->quantity >= $item->product->stock ? 'disabled' : '' }}>
                                                        <i class="fas fa-plus text-sm"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-gray-600 text-sm">Subtotal</p>
                                            <p class="text-lg font-bold text-gray-800">
                                                ${{ number_format($item->product->price * $item->quantity, 2) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <!-- Empty Cart -->
                        <div class="p-12 text-center">
                            <div class="text-gray-400 mb-4">
                                <i class="fas fa-shopping-cart text-6xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-600 mb-2">Your cart is empty</h3>
                            <p class="text-gray-500 mb-6">Start shopping to add items to your cart</p>
                            <a href="{{ route('products') }}" 
                               class="inline-flex items-center px-6 py-3 bg-[#10a2a2] text-white rounded-lg hover:bg-[#0d8c8c] transition duration-300">
                                <i class="fas fa-shopping-bag mr-2"></i>
                                Start Shopping
                            </a>
                        </div>
                        @endforelse
                    </div>

                    <!-- Cart Actions -->
                    @if($cartItems->count() > 0)
                    <div class="border-t border-gray-200 px-6 py-4">
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                            <a href="{{ route('products') }}" 
                               class="flex items-center text-[#10a2a2] hover:text-[#0d8c8c] transition duration-300">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Continue Shopping
                            </a>
                            <div class="flex space-x-4">
                                <form action="{{ route('cart.clear') }}" method="POST">
                                    @csrf
                                    <button type="submit" 
                                            onclick="return confirm('Are you sure you want to clear your entire cart?')"
                                            class="px-6 py-2 border border-red-300 text-red-600 rounded-lg hover:bg-red-50 transition duration-300">
                                        Clear Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Order Summary -->
            @if($cartItems->count() > 0)
            <div class="lg:w-1/3">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 sticky top-4">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h2 class="text-xl font-semibold text-gray-800">Order Summary</h2>
                    </div>

                    <div class="p-6">
                        <!-- Summary Details -->
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal ({{ $cartItems->sum('quantity') }} items)</span>
                                <span>${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span>
                                    @if($shipping == 0)
                                        <span class="text-green-600">FREE</span>
                                    @else
                                        ${{ number_format($shipping, 2) }}
                                    @endif
                                </span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Tax</span>
                                <span>${{ number_format($tax, 2) }}</span>
                            </div>
                            <div class="border-t border-gray-200 pt-3">
                                <div class="flex justify-between text-lg font-bold text-gray-800">
                                    <span>Total</span>
                                    <span>${{ number_format($total, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Promo Code -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Promo Code</label>
                            <div class="flex gap-2">
                                <input type="text" 
                                       placeholder="Enter promo code" 
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2]">
                                <button class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition duration-300">
                                    Apply
                                </button>
                            </div>
                        </div>

                        <!-- Checkout Button -->
                        <a href="{{ route('checkout') }}" 
                        class="w-full bg-gray-800 text-white py-3 rounded-lg font-semibold hover:bg-green-600 transition duration-300 transform hover:scale-105 mb-4 text-center block">
                            Proceed to Checkout
                        </a>

                        <!-- Security Info -->
                        <div class="text-center text-sm text-gray-500">
                            <div class="flex justify-center items-center space-x-2 mb-2">
                                <i class="fas fa-lock text-green-500"></i>
                                <span>Secure checkout</span>
                            </div>
                            <p>Your personal information is safe with us</p>
                        </div>
                    </div>
                </div>

                <!-- Trust Badges -->
                <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Why Shop With Us?</h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-shipping-fast text-[#10a2a2] mr-3"></i>
                            <span class="text-sm text-gray-600">Free shipping on orders over $50</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-shield-alt text-[#10a2a2] mr-3"></i>
                            <span class="text-sm text-gray-600">Secure payment processing</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-undo text-[#10a2a2] mr-3"></i>
                            <span class="text-sm text-gray-600">30-day return policy</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-headset text-[#10a2a2] mr-3"></i>
                            <span class="text-sm text-gray-600">24/7 customer support</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    function updateQuantity(itemId, newQuantity) {
        if (newQuantity < 1) return;
        
        // AJAX request to update quantity
        fetch('{{ route("cart.update") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                item_id: itemId,
                quantity: newQuantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update quantity display
                document.querySelector('.quantity-display-' + itemId).textContent = newQuantity;
                // Reload page to update totals
                location.reload();
            } else {
                alert(data.message || 'Error updating quantity');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error updating quantity');
        });
    }

    // Update cart count in navbar
    document.addEventListener('DOMContentLoaded', function() {
        const cartCount = {{ $cartItems->count() }};
        const cartBadge = document.querySelector('a[href="{{ route("cart") }}"] .bg-[#10a2a2]');
        if (cartBadge) {
            cartBadge.textContent = cartCount;
        }
    });
</script>
@endpush