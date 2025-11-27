@extends('layouts.main')

@section('title', 'Products - VHGH')

@section('content')
    <!-- Products Header -->
    <section class="bg-gray-100 py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Our Products</h1>
            <p class="text-gray-600">Discover amazing anime merchandise</p>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <!-- Welcome Message untuk User Baru -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Search and Filter -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <form action="{{ route('products.search') }}" method="GET" class="relative mb-4 md:mb-0">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search products..." 
                           class="pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300 w-80">
                    <i class="fas fa-search absolute left-4 top-3 text-gray-400"></i>
                </form>
                
                <div class="flex items-center space-x-4">
                    <select class="border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#10a2a2]">
                        <option>All Categories</option>
                        <option>Figures</option>
                        <option>Apparel</option>
                        <option>Accessories</option>
                    </select>
                    <select class="border border-gray-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#10a2a2]">
                        <option>Sort by: Latest</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                    </select>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @for($i = 1; $i <= 8; $i++)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                    <img src="https://images.unsplash.com/photo-1545569341-9eb8b30979d9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Product {{ $i }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold mb-2 text-gray-800">Anime Figure - Character {{ $i }}</h3>
                        <p class="text-gray-600 text-sm mb-2">High quality collectible figure</p>
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-[#10a2a2] font-bold text-lg">${{ rand(20, 50) }}.99</span>
                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">In Stock</span>
                        </div>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $i }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="bg-[#10a2a2] text-white px-4 py-2 rounded-lg w-full hover:bg-[#0d8c8c] transition duration-300 flex items-center justify-center">
                                <i class="fas fa-cart-plus mr-2"></i> Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </section>
@endsection