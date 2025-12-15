@extends('layouts.main')

@section('title', $product->name . ' - VHGH')

@section('content')
<!-- Product Header -->
<section class="bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
                <div class="text-sm text-gray-500">
                    <a href="{{ route('home') }}" class="text-[#10a2a2] hover:text-[#0d8c8c]">Home</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('products') }}" class="text-[#10a2a2] hover:text-[#0d8c8c]">Products</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-400">{{ $product->name }}</span>
                </div>
            </div>
            <div class="text-sm text-gray-500">
                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                    {{ $product->category }}
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Product Detail Section -->
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

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Product Images -->
            <div>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-4">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                         class="w-full h-96 object-cover">
                </div>
            </div>

            <!-- Product Info -->
            <div>
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $product->name }}</h2>
                    
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 mr-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star{{ $i <= 4 ? '' : '-half-alt' }}"></i>
                            @endfor
                        </div>
                        <span class="text-gray-600 text-sm">(42 reviews)</span>
                    </div>

                    <p class="text-gray-600 mb-6 leading-relaxed">{{ $product->description }}</p>

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Product Details</h3>
                        <ul class="text-gray-600 space-y-1">
                    
                            <li><strong>Stock:</strong> <span class="{{ $product->inStock() ? 'text-green-600' : 'text-red-600' }}">{{ $product->stock }} items available</span></li>
                            <li><strong>SKU:</strong> VHGH-{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</li>
                        </ul>
                    </div>

                    <div class="border-t border-gray-200 pt-6 mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-3xl font-bold text-[#10a2a2]">${{ number_format($product->price, 2) }}</span>
                            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $product->inStock() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $product->inStock() ? 'In Stock' : 'Out of Stock' }}
                            </span>
                        </div>

                     @if($product->inStock())
<form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">

    <!-- QUANTITY -->
    <div class="flex items-center gap-4 mb-6">
        <span class="font-medium text-gray-700">Quantity:</span>

        <div class="flex items-center border rounded-lg">
            <button type="button" onclick="decreaseQuantity()"
                class="px-3 py-2 text-gray-600">−</button>

            <input type="number" id="quantity" name="quantity"
                value="1" min="1" max="{{ $product->stock }}"
                class="w-16 text-center border-0 focus:ring-0">

            <button type="button" onclick="increaseQuantity()"
                class="px-3 py-2 text-gray-600">+</button>
        </div>

        <span class="text-sm text-gray-500">
            Max: {{ $product->stock }}
        </span>
    </div>

    <!-- BUTTONS (INI YANG HILANG DI KAMU) -->
    <div class="flex gap-4">
        <!-- ADD TO CART -->
        <button type="submit"
            class="flex-1 bg-[#10a2a2] text-white py-3 px-6 rounded-lg
                   font-semibold hover:bg-[#0d8c8c]
                   flex items-center justify-center">
            <i class="fas fa-cart-plus mr-2"></i>
            Add to Cart
        </button>

        <!-- BUY NOW -->
        <button type="button"
            onclick="buyNow()"
            class="flex-1 bg-gray-800 text-white py-3 px-6 rounded-lg
                   font-semibold hover:bg-gray-900
                   flex items-center justify-center">
            <i class="fas fa-bolt mr-2"></i>
            Buy Now
        </button>
    </div>
</form>


                        @else
                        <div class="text-center py-4">
                            <p class="text-red-600 font-semibold mb-4">This product is currently out of stock</p>
                            <button disabled class="bg-gray-400 text-white py-3 px-6 rounded-lg font-semibold cursor-not-allowed">
                                Out of Stock
                            </button>
                        </div>
                        @endif
                    </div>

                    <!-- Trust Badges -->
                    <div class="border-t border-gray-200 pt-6">
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div class="flex items-center justify-center space-x-2 text-sm text-gray-600">
                                <i class="fas fa-shipping-fast text-[#10a2a2]"></i>
                                <span>Free Shipping</span>
                            </div>
                            <div class="flex items-center justify-center space-x-2 text-sm text-gray-600">
                                <i class="fas fa-shield-alt text-[#10a2a2]"></i>
                                <span>Secure Payment</span>
                            </div>
                            <div class="flex items-center justify-center space-x-2 text-sm text-gray-600">
                                <i class="fas fa-undo text-[#10a2a2]"></i>
                                <span>30-Day Returns</span>
                            </div>
                            <div class="flex items-center justify-center space-x-2 text-sm text-gray-600">
                                <i class="fas fa-headset text-[#10a2a2]"></i>
                                <span>24/7 Support</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
      
        </div>
    </div>
</section>

@push('scripts')
<script>
    function increaseQuantity() {
        const quantityInput = document.getElementById('quantity');
        const max = parseInt(quantityInput.max);
        const current = parseInt(quantityInput.value);
        if (current < max) {
            quantityInput.value = current + 1;
        }
    }

    function decreaseQuantity() {
        const quantityInput = document.getElementById('quantity');
        const current = parseInt(quantityInput.value);
        if (current > 1) {
            quantityInput.value = current - 1;
        }
    }

    function buyNow() {
        const quantity = document.getElementById('quantity').value;
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("cart.add") }}';
        
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        form.appendChild(csrf);
        
        const productId = document.createElement('input');
        productId.type = 'hidden';
        productId.name = 'product_id';
        productId.value = '{{ $product->id }}';
        form.appendChild(productId);
        
        const quantityInput = document.createElement('input');
        quantityInput.type = 'hidden';
        quantityInput.name = 'quantity';
        quantityInput.value = quantity;
        form.appendChild(quantityInput);
        
        document.body.appendChild(form);
        form.submit();
        
        // Redirect to cart after adding
        setTimeout(() => {
            window.location.href = '{{ route("cart") }}';
        }, 100);
    }

    // Quantity input validation
    document.getElementById('quantity').addEventListener('change', function() {
        const max = parseInt(this.max);
        const value = parseInt(this.value);
        if (value < 1) this.value = 1;
        if (value > max) this.value = max;
    });
</script>
@endpush
@endsection