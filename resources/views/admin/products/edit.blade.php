@extends('layouts.admin')

@section('title', 'Edit Product - Admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Edit Product</h1>
        <p class="text-gray-600">Update product information</p>
    </div>
    <a href="{{ route('admin.products') }}" 
       class="bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 transition duration-300">
        <i class="fas fa-arrow-left mr-2"></i> Back to Products
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <!-- Form Header -->
    <div class="border-b border-gray-200 px-6 py-4">    
        <h2 class="text-xl font-semibold text-gray-800">Edit Product Information</h2>
        <p class="text-gray-600 text-sm mt-1">Update the details for {{ $product->name }}</p>
    </div>

    <!-- Product Form -->
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" class="p-6">
        @csrf
        @method('POST')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Basic Information -->
            <div class="md:col-span-2">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">Basic Information</h3>
            </div>

            <!-- Product Name -->
            <div class="md:col-span-2">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Product Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300"
                       placeholder="Enter product name">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                <textarea id="description" name="description" rows="4" required
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300"
                          placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pricing & Stock -->
            <div class="md:col-span-2">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">Pricing & Inventory</h3>
            </div>

            <!-- Price -->
           <div>
    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
        Price (Rp) *
    </label>

    <div class="relative">
        <span
            class="absolute inset-y-0 left-4 flex items-center text-gray-500 font-medium pointer-events-none">
            Rp
        </span>

        <input
            type="text"
            id="price"
            name="price"
            value="{{ old('price', $product->price) }}"
            required
            inputmode="numeric"
            class="w-full pl-14 pr-4 py-3 border border-gray-300 rounded-lg
                   focus:outline-none focus:ring-2 focus:ring-[#10a2a2]
                   focus:border-[#10a2a2] transition duration-300"
            placeholder="0"
        >
    </div>

    @error('price')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

            <!-- Stock -->
            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">Stock Quantity *</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300"
                       placeholder="Enter stock quantity">
                @error('stock')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sales Stats (Readonly) -->
            <div class="md:col-span-2 grid grid-cols-2 gap-4 p-4 bg-gray-50 rounded-lg">
                <div class="text-center">
                    <p class="text-sm text-gray-600">Total Sold</p>
                    <p class="text-lg font-bold text-[#10a2a2]">{{ $product->total_sold }}</p>
                </div>
              <div class="text-center">
    <p class="text-sm text-gray-600">Total Revenue</p>
    <p class="text-lg font-bold text-[#10a2a2]">
        Rp {{ number_format($product->total_revenue, 0, ',', '.') }}
    </p>
</div>

            </div>

            <!-- Category & Image -->
            <div class="md:col-span-2">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">Media</h3>
            </div>

            <!-- Category -->
          

            <!-- Image URL -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image URL *</label>
                <input type="text" id="image" name="image" value="{{ old('image', $product->image) }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300"
                       placeholder="https://example.com/image.jpg">
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Current Image & Preview -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Image Preview</label>
                
                <!-- Current Image -->
                <div class="mb-4">
                    <p class="text-sm text-gray-600 mb-2">Current Image:</p>
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                         class="h-32 rounded-lg border border-gray-300">
                </div>

                <!-- New Image Preview -->
                <div id="imagePreview" class="mt-2 border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hidden">
                    <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
                    <img id="previewImage"
     referrerpolicy="no-referrer"
     class="mx-auto max-h-48 rounded-lg hidden">

                    <p id="previewText" class="text-gray-500 text-sm mt-2">New image preview will appear here</p>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="mt-8 flex justify-between items-center">
            <div class="text-sm text-gray-500">
                <p>Created: {{ $product->created_at->format('M d, Y') }}</p>
                <p>Last Updated: {{ $product->updated_at->format('M d, Y') }}</p>
            </div>
            
            <div class="flex space-x-4">
                <a href="{{ route('admin.products') }}" 
                   class="bg-gray-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-600 transition duration-300">
                    Cancel
                </a>
              <button type="submit" 
        class="bg-black text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-800 transition duration-300 transform hover:scale-105 shadow-md">
    <i class="fas fa-save mr-2"></i>Update Product
</button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const input = document.getElementById('image');
    const previewContainer = document.getElementById('imagePreview');
    const previewImage = document.getElementById('previewImage');
    const previewText = document.getElementById('previewText');

    const currentImage = "{{ $product->image }}";

    input.addEventListener('input', () => {
        const url = input.value.trim();

        // kosong atau sama dengan gambar lama
        if (!url || url === currentImage) {
            previewContainer.classList.add('hidden');
            previewImage.src = '';
            return;
        }

        // validasi ekstensi gambar
        if (!url.match(/\.(jpg|jpeg|png|webp)$/i)) {
            previewContainer.classList.remove('hidden');
            previewImage.classList.add('hidden');
            previewText.textContent = 'URL harus gambar (.jpg, .png, .webp)';
            previewText.className = 'text-red-600 text-sm mt-2';
            return;
        }

        previewContainer.classList.remove('hidden');
        previewText.textContent = 'Loading new image...';
        previewText.className = 'text-gray-500 text-sm mt-2';
        previewImage.classList.add('hidden');

        // 🔥 FIX UTAMA
        previewImage.src = '';
        previewImage.referrerPolicy = "no-referrer";

        previewImage.onload = () => {
            previewImage.classList.remove('hidden');
            previewText.textContent = 'New image preview loaded';
            previewText.className = 'text-green-600 text-sm mt-2';
        };

        previewImage.onerror = () => {
            previewImage.classList.add('hidden');
            previewText.textContent = 'Gambar tidak bisa dimuat';
            previewText.className = 'text-red-600 text-sm mt-2';
        };

        previewImage.src = url;
    });
});
</script>
@endpush

@endsection