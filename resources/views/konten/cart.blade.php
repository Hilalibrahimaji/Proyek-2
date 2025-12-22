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
                <a href="{{ route('home') }}" class="text-[#48c0b0] hover:text-[#40b4a3] transition duration-300">Home</a> 
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

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Cart Items -->
            <div class="lg:w-2/3">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <!-- Cart Header -->
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h2 class="text-xl font-semibold text-gray-800">
                            Cart Items ({{ count($cartItems) }})
                        </h2>
                    </div>

                    <!-- Cart Items List -->
                    <div class="divide-y divide-gray-200">
                        @forelse($cartItems as $item)
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <!-- Product Image -->
                                <div class="sm:w-24 sm:h-24 w-full h-48 shrink-0">
                                    <img src="{{ $item['image'] }}" 
                                        alt="{{ $item['name'] }}" 
                                        class="w-full h-full object-cover rounded-lg">
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                                {{ $item['name'] }}
                                            </h3>
                                            <p class="text-[#48c0b0] font-bold text-xl mb-2">
                                                ${{ number_format($item['price'], 2) }}
                                            </p>
                                            <p class="text-sm text-gray-600 mb-4">
                                                In stock: <span class="text-green-600">{{ $item['stock'] }} items</span>
                                            </p>
                                        </div>
                                        <button class="text-gray-400 hover:text-red-500 transition duration-300"
                                                onclick="removeItem({{ $item['id'] }})">
                                            <i class="fas fa-trash text-lg"></i>
                                        </button>
                                    </div>

                                    <!-- Quantity Controls -->
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center space-x-3">
                                            <span class="text-gray-700 font-medium">Quantity:</span>
                                            <div class="flex items-center border border-gray-300 rounded-lg">
                                                <button class="px-3 py-1 text-gray-600 hover:text-gray-800 transition duration-300"
                                                        onclick="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] - 1 }})">
                                                    <i class="fas fa-minus text-sm"></i>
                                                </button>
                                                <span class="px-4 py-1 text-gray-800 font-medium">
                                                    {{ $item['quantity'] }}
                                                </span>
                                                <button class="px-3 py-1 text-gray-600 hover:text-gray-800 transition duration-300"
                                                        onclick="updateQuantity({{ $item['id'] }}, {{ $item['quantity'] + 1 }})">
                                                    <i class="fas fa-plus text-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-gray-600 text-sm">Subtotal</p>
                                            <p class="text-lg font-bold text-gray-800">
                                                ${{ number_format($item['price'] * $item['quantity'], 2) }}
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
                            class="inline-flex items-center px-6 py-3 bg-[#48c0b0] text-white rounded-lg hover:bg-[#40b4a3] transition duration-300">
                                <i class="fas fa-shopping-bag mr-2"></i>
                                Start Shopping
                            </a>
                        </div>
                        @endforelse
                    </div>

                    <!-- Cart Actions -->
                    @if(count($cartItems) > 0)
                    <div class="border-t border-gray-200 px-6 py-4">
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                            <a href="{{ route('products') }}" 
                            class="flex items-center text-[#48c0b0] hover:text-[#40b4a3] transition duration-300">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Continue Shopping
                            </a>
                            <button class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-300">
                                Update Cart
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Order Summary -->
            @if(count($cartItems) > 0)
            <div class="lg:w-1/3">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 sticky top-4">
                    <div class="border-b border-gray-200 px-6 py-4">
                        <h2 class="text-xl font-semibold text-gray-800">Order Summary</h2>
                    </div>

                    <div class="p-6">
                        <!-- Summary Details -->
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal ({{ count($cartItems) }} items)</span>
                                <span>${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Shipping</span>
                                <span>${{ number_format($shipping, 2) }}</span>
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
                                    class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#48c0b0] focus:border-[#48c0b0]">
                                <button class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition duration-300">
                                    Apply
                                </button>
                            </div>
                        </div>

                        <!-- Checkout Button -->
                        <button class="w-full bg-[#48c0b0] text-white py-3 rounded-lg font-semibold hover:bg-[#40b4a3] transition duration-300 transform hover:scale-105 mb-4">
                            Proceed to Checkout
                        </button>

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
                            <i class="fas fa-shipping-fast text-[#48c0b0] mr-3"></i>
                            <span class="text-sm text-gray-600">Free shipping on orders over $50</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-shield-alt text-[#48c0b0] mr-3"></i>
                            <span class="text-sm text-gray-600">Secure payment processing</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-undo text-[#48c0b0] mr-3"></i>
                            <span class="text-sm text-gray-600">30-day return policy</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-headset text-[#48c0b0] mr-3"></i>
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
        
        // Dalam real application, ini akan AJAX request
        console.log(`Update item ${itemId} quantity to ${newQuantity}`);
        // location.reload(); // Untuk demo
    }

    function removeItem(itemId) {
        if (confirm('Are you sure you want to remove this item from your cart?')) {
            // Dalam real application, ini akan AJAX request
            console.log(`Remove item ${itemId} from cart`);
            // Submit form untuk remove item
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("cart.remove") }}';
            
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            form.appendChild(csrf);
            
            const itemInput = document.createElement('input');
            itemInput.type = 'hidden';
            itemInput.name = 'item_id';
            itemInput.value = itemId;
            form.appendChild(itemInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    }

    // Update cart count in navbar
    document.addEventListener('DOMContentLoaded', function() {
        const cartCount = {{ count($cartItems) }};
        const cartBadge = document.querySelector('a[href="{{ route("cart") }}"] .bg-purple-600');
        if (cartBadge) {
            cartBadge.textContent = cartCount;
        }
    });
</script>
@endpush