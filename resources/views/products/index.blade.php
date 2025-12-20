@extends('layouts.main')

@section('title', 'Products - VHGH')

@section('content')
    <!-- Products Header -->
    <section class="bg-gray-100 py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">
                @if(isset($category))
                    {{ ucfirst($category) }} - Our Products
                @elseif(isset($query))
                    Search Results for "{{ $query }}"
                @else
                    Our Products
                @endif
            </h1>
            <p class="text-gray-600">
                @if(isset($category))
                    Discover amazing {{ strtolower($category) }} merchandise
                @elseif(isset($query))
                    Found {{ $products->count() }} results
                @else
                    Discover amazing anime merchandise
                @endif
            </p>
        </div>
    </section>

    <!-- Products Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Search and Filter -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <form action="{{ route('products.search') }}" method="GET" class="relative mb-4 md:mb-0">
                    <input type="text" name="q" value="{{ $query ?? '' }}" placeholder="Search products..." 
                           class="pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300 w-80">
                    <i class="fas fa-search absolute left-4 top-3 text-gray-400"></i>
                </form>
                
                <div class="flex items-center space-x-4">
                    
                    
                  <form method="GET" action="{{ route('products') }}">
    {{-- biar search nggak ilang --}}
    @if(request('q'))
        <input type="hidden" name="q" value="{{ request('q') }}">
    @endif

    <select name="sort"
            onchange="this.form.submit()"
            class="border border-gray-300 rounded-lg px-4 py-3
                   focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2]">
        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>
            Sort by: Latest
        </option>
        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
            Price: Low to High
        </option>
        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
            Price: High to Low
        </option>
    </select>
</form>

                </div>
            </div>

            <!-- Products Grid -->
            <!-- Products Grid -->
@if($products->count() > 0)
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    @foreach($products as $product)
    <!-- Di dalam product loop -->
 <div class="bg-sky-200 rounded-lg shadow-md overflow-hidden">

        <a href="{{ route('products.show', $product->id) }}">
    <div class="w-full h-48 bg-white overflow-hidden">
        <img src="{{ $product->image }}" alt="{{ $product->name }}"
             class="w-full h-full object-contain p-4">
    </div>
</a>

     <div class="p-4 bg-blue-200 border-t border-teal-200">


            <a href="{{ route('products.show', $product->id) }}" class="hover:text-[#10a2a2] transition duration-300">
                <h3 class="font-semibold mb-2 text-gray-800">{{ $product->name }}</h3>
            </a>
            <p class="text-gray-600 text-sm mb-2">{{ Str::limit($product->description, 80) }}</p>
            <div class="flex justify-between items-center mb-3">
                <span class="text-[#10a2a2] font-bold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</span>

                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">
                    {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                </span>
            </div>
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" 
                        class="bg-[#10a2a2] text-black px-4 py-2 rounded-lg w-full hover:bg-[#0d8c8c] transition duration-300 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                        {{ $product->stock == 0 ? 'disabled' : '' }}>
                    <i class="fas fa-cart-plus mr-2"></i> 
                    {{ $product->stock > 0 ? 'Add to Cart' : 'Out of Stock' }}
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>
            @else
            <!-- No Products Found -->
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-search text-6xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No products found</h3>
                <p class="text-gray-500 mb-6">
                    @if(isset($query))
                        No products match your search for "{{ $query }}"
                    @else
                        No products available in this category
                    @endif
                </p>
                <a href="{{ route('products') }}" 
                   class="inline-flex items-center px-6 py-3 bg-[#10a2a2] text-white rounded-lg hover:bg-[#0d8c8c] transition duration-300">
                    <i class="fas fa-store mr-2"></i>
                    Browse All Products
                </a>
            </div>
            @endif
        </div>
    </section>
@endsection