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
                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price ($) *</label>
                <div class="relative">
                    <span class="absolute left-3 top-3 text-gray-500">$</span>
                    <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" required
                           class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300"
                           placeholder="0.00">
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
                    <p class="text-lg font-bold text-[#10a2a2]">{{ $product->formatted_total_revenue }}</p>
                </div>
            </div>

            <!-- Category & Image -->
            <div class="md:col-span-2">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">Media & Category</h3>
            </div>

            <!-- Category -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                <select id="category" name="category" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300">
                    <option value="">Select Category</option>
                    <option value="Figures" {{ old('category', $product->category) == 'Figures' ? 'selected' : '' }}>Figures</option>
                    <option value="Apparel" {{ old('category', $product->category) == 'Apparel' ? 'selected' : '' }}>Apparel</option>
                    <option value="Accessories" {{ old('category', $product->category) == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                    <option value="Collectibles" {{ old('category', $product->category) == 'Collectibles' ? 'selected' : '' }}>Collectibles</option>
                    <option value="Posters" {{ old('category', $product->category) == 'Posters' ? 'selected' : '' }}>Posters</option>
                    <option value="Keychains" {{ old('category', $product->category) == 'Keychains' ? 'selected' : '' }}>Keychains</option>
                </select>
                @error('category')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image URL -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image URL *</label>
                <input type="url" id="image" name="image" value="{{ old('image', $product->image) }}" required
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
                    <img id="previewImage" src="" alt="Preview" class="mx-auto max-h-48 rounded-lg hidden">
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
                        class="bg-[#10a2a2] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#0d8c8c] transition duration-300 transform hover:scale-105 shadow-md">
                    <i class="fas fa-save mr-2"></i>Update Product
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Image preview functionality
    document.getElementById('image').addEventListener('input', function() {
        const imageUrl = this.value;
        const previewContainer = document.getElementById('imagePreview');
        const previewImage = document.getElementById('previewImage');
        const previewText = document.getElementById('previewText');

        if (imageUrl && imageUrl !== '{{ $product->image }}') {
            previewContainer.classList.remove('hidden');
            
            previewImage.onload = function() {
                previewImage.classList.remove('hidden');
                previewText.textContent = 'New image preview loaded successfully';
                previewText.className = 'text-green-600 text-sm mt-2';
            };
            
            previewImage.onerror = function() {
                previewImage.classList.add('hidden');
                previewText.textContent = 'Failed to load image. Please check the URL.';
                previewText.className = 'text-red-600 text-sm mt-2';
            };
            
            previewImage.src = imageUrl;
        } else {
            previewContainer.classList.add('hidden');
        }
    });

    // Auto-format price input
    document.getElementById('price').addEventListener('blur', function() {
        const value = parseFloat(this.value);
        if (!isNaN(value)) {
            this.value = value.toFixed(2);
        }
    });

    // Character counter for description
    const descriptionField = document.getElementById('description');
    descriptionField.addEventListener('input', function() {
        const charCount = this.value.length;
        let counter = document.getElementById('charCounter');
        
        if (!counter) {
            counter = document.createElement('div');
            counter.id = 'charCounter';
            counter.className = 'text-sm text-gray-500 mt-1';
            this.parentNode.appendChild(counter);
        }
        
        counter.textContent = `${charCount} characters`;
        
        if (charCount > 500) {
            counter.className = 'text-sm text-red-600 mt-1';
        } else if (charCount > 300) {
            counter.className = 'text-sm text-yellow-600 mt-1';
        } else {
            counter.className = 'text-sm text-gray-500 mt-1';
        }
    });

    // Initialize character counter on page load
    document.addEventListener('DOMContentLoaded', function() {
        const charCount = descriptionField.value.length;
        const counter = document.createElement('div');
        counter.id = 'charCounter';
        counter.className = 'text-sm text-gray-500 mt-1';
        counter.textContent = `${charCount} characters`;
        descriptionField.parentNode.appendChild(counter);
    });
</script>
@endpush
@endsection