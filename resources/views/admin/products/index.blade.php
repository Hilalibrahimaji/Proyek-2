@extends('layouts.admin')

@section('title', 'Manage Products')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Product Management</h1>
        <p class="text-gray-600">Manage all products in the store</p>
    </div>
   <a href="{{ route('admin.products.create') }}" 
   class="bg-black text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-800 transition duration-300">

        <i class="fas fa-plus mr-2"></i> Add New Product
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="px-6 py-4 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">All Products ({{ $products->count() }})</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($products as $product)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                                 class="w-12 h-12 rounded object-cover mr-3">
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($product->description, 50) }}</div>
                            </div>
                        </div>
                    </td>
                  
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        ${{ number_format($product->price, 2) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $product->stock }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs rounded-full {{ $product->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}" 
                           class="text-[#10a2a2] hover:text-[#0d8c8c] transition duration-300">
                            <i class="fas fa-edit mr-1"></i> Edit
                        </a>
                        <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Are you sure you want to delete {{ $product->name }}?')"
                                    class="text-red-600 hover:text-red-900 transition duration-300">
                                <i class="fas fa-trash mr-1"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($products->isEmpty())
    <div class="text-center py-12">
        <i class="fas fa-box text-4xl text-gray-400 mb-4"></i>
        <h3 class="text-lg font-semibold text-gray-600">No products found</h3>
        <p class="text-gray-500">Get started by adding your first product.</p>
        <a href="{{ route('admin.products.create') }}" 
           class="inline-block mt-4 bg-[#10a2a2] text-white px-6 py-2 rounded-lg font-semibold hover:bg-[#0d8c8c] transition duration-300">
            Add Product
        </a>
    </div>
    @endif
</div>
@endsection