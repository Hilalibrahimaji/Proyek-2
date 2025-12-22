@extends('layouts.main')

@section('title', 'Checkout - VHGH')

@section('content')
<!-- Checkout Header -->
<section class="bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Checkout</h1>
                <p class="text-gray-600">Complete your order</p>
            </div>
            <div class="text-sm text-gray-500">
                <a href="{{ route('home') }}" class="text-[#10a2a2] hover:text-[#0d8c8c]">Home</a> 
                <span class="mx-2">/</span>
                <a href="{{ route('cart') }}" class="text-[#10a2a2] hover:text-[#0d8c8c]">Cart</a>
                <span class="mx-2">/</span>
                <span class="text-gray-400">Checkout</span>
            </div>
        </div>
    </div>
</section>

<!-- Checkout Section -->
<section class="py-12">
    <div class="container mx-auto px-4">
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Shipping Information -->
                <div>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Shipping Information</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="md:col-span-2">
                                <label for="shipping_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                                <input type="text" id="shipping_name" name="shipping_name" 
                                       value="{{ auth()->user()->name }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300">
                            </div>

                            <div>
                                <label for="shipping_email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                <input type="email" id="shipping_email" name="shipping_email" 
                                       value="{{ auth()->user()->email }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300">
                            </div>

                            <div>
                                <label for="shipping_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone *</label>
                                <input type="tel" id="shipping_phone" name="shipping_phone" 
                                       value="{{ auth()->user()->phone }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300">
                            </div>

                            <div class="md:col-span-2">
                                <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-2">Address *</label>
                                <textarea id="shipping_address" name="shipping_address" rows="3" required
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300">{{ auth()->user()->address }}</textarea>
                            </div>

                            <div>
                                <label for="shipping_city" class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                                <input type="text" id="shipping_city" name="shipping_city" 
                                       value="{{ auth()->user()->city }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300">
                            </div>

                            <div>
                                <label for="shipping_postal_code" class="block text-sm font-medium text-gray-700 mb-2">Postal Code *</label>
                                <input type="text" id="shipping_postal_code" name="shipping_postal_code" 
                                       value="{{ auth()->user()->postal_code }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300">
                            </div>

                            <div class="md:col-span-2">
                                <label for="shipping_country" class="block text-sm font-medium text-gray-700 mb-2">Country *</label>
                                <input type="text" id="shipping_country" name="shipping_country" 
                                       value="{{ auth()->user()->country ?? 'Japan' }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300">
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Centang Ini</h2>
                        
                    

                        <!-- Terms and Conditions -->
                        <div class="mt-6">
                            <div class="flex items-center">
                                <input type="checkbox" id="agree_terms" name="agree_terms" required
                                       class="h-4 w-4 text-[#10a2a2] focus:ring-[#10a2a2] border-gray-300 rounded">
                                <label for="agree_terms" class="ml-2 block text-sm text-gray-700">
                                    I agree to the <a href="#" class="text-[#10a2a2] hover:text-[#0d8c8c]">Terms and Conditions</a>
                                    and <a href="#" class="text-[#10a2a2] hover:text-[#0d8c8c]">Privacy Policy</a>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 sticky top-4">
                        <div class="border-b border-gray-200 px-6 py-4">
                            <h2 class="text-xl font-semibold text-gray-800">Order Summary</h2>
                        </div>

                        <div class="p-6">
                            <!-- Order Items -->
                            <div class="space-y-4 mb-6">
                                @foreach($cartItems as $item)
                                <div class="flex items-center space-x-3">
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" 
                                         class="w-12 h-12 rounded object-cover">
                                    <div class="flex-1">
                                        <h4 class="text-sm font-medium text-gray-800">{{ $item->product->name }}</h4>
                                        <p class="text-sm text-gray-600">Qty: {{ $item->quantity }}</p>
                                    </div>
                                    <span>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>

                                </div>
                                @endforeach
                            </div>

                            <!-- Price Breakdown -->
                            <div class="space-y-2 border-t border-gray-200 pt-4">
                                <div class="flex justify-between text-gray-600">
                                    <span>Subtotal</span>
                                    <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>

                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Shipping</span>
                                    <span>
                                        @if($shipping == 0)
                                            <span class="text-green-600">FREE</span>
                                        @else
                                           Rp {{ number_format($shipping, 0, ',', '.') }}

                                        @endif
                                    </span>
                                </div>
                                <div class="flex justify-between text-gray-600">
                                    <span>Tax</span>
                                    <span>Rp {{ number_format($tax, 0, ',', '.') }}</span>

                                </div>
                                <div class="flex justify-between text-lg font-bold text-gray-800 border-t border-gray-200 pt-2">
                                    <span>Total</span>
                                    <span>Rp {{ number_format($total, 0, ',', '.') }}</span>

                                </div>
                            </div>

                            <!-- Place Order Button -->
                            <button type="submit" 
                                    class="w-full bg-gray-800 text-white py-4 rounded-lg font-semibold hover:bg-green-600 transition duration-300 transform hover:scale-105 mt-6">
                                <i class="fas fa-lock mr-2"></i>Place Order
                            </button>

                            <!-- Security Info -->
                            <div class="text-center text-sm text-gray-500 mt-4">
                                <div class="flex justify-center items-center space-x-2 mb-2">
                                    <i class="fas fa-shield-alt text-green-500"></i>
                                    <span>Secure SSL Encryption</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        const submitButton = this.querySelector('button[type="submit"]');
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
    });
</script>
@endpush