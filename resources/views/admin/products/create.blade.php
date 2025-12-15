@extends('layouts.admin')

@section('title', 'Add New Product - Admin')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Add New Product</h1>
        <p class="text-gray-600">Create a new product for your store</p>
    </div>
    <a href="{{ route('admin.products') }}" 
       class="bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-700 transition duration-300">
        <i class="fas fa-arrow-left mr-2"></i> Back to Products
    </a>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <!-- Form Header -->
    <div class="border-b border-gray-200 px-6 py-4">
        <h2 class="text-xl font-semibold text-gray-800">Product Information</h2>
        <p class="text-gray-600 text-sm mt-1">Fill in the details for the new product</p>
    </div>

    <!-- Product Form -->
    <form action="{{ route('admin.products.store') }}" method="POST" class="p-6">
        @csrf
        
       
            <!-- Basic Information -->
            <div class="md:col-span-2">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">Basic Information</h3>
            </div>

            <!-- Product Name -->
            <div class="md:col-span-2">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Product Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
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
                          placeholder="Enter product description">{{ old('description') }}</textarea>
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
                    <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" min="0" required
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
                <input type="number" id="stock" name="stock" value="{{ old('stock') }}" min="0" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300"
                       placeholder="Enter stock quantity">
                @error('stock')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image -->
            <div class="md:col-span-2">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b border-gray-200 pb-2">Media</h3>
            </div>

        

            <!-- Image URL -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image URL *</label>
                <input type="url" id="image" name="image" value="{{ old('image') }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300"
                       placeholder="https://example.com/image.jpg">
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image Preview -->
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-2">Image Preview</label>
                <div id="imagePreview" class="mt-2 border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hidden">
                    <img id="previewImage" src="" alt="Preview" class="mx-auto max-h-48 rounded-lg hidden">
                    <p id="previewText" class="text-gray-500 text-sm mt-2">Image preview will appear here</p>
                </div>
                <div id="noPreview" class="mt-2 text-center py-8 border-2 border-dashed border-gray-300 rounded-lg">
                    <i class="fas fa-image text-gray-400 text-3xl mb-2"></i>
                    <p class="text-gray-500 text-sm">Enter image URL to see preview</p>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="mt-8 flex justify-end space-x-4">
            <a href="{{ route('admin.products') }}" 
               class="bg-gray-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-600 transition duration-300">
                Cancel
            </a>
         <button type="submit"
        class="bg-black text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-800 transition duration-300 transform hover:scale-105 shadow-md">
    <i class="fas fa-save mr-2"></i>Create Product
</button>


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
        const noPreview = document.getElementById('noPreview');

        if (imageUrl) {
            previewContainer.classList.remove('hidden');
            noPreview.classList.add('hidden');
            
            previewImage.onload = function() {
                previewImage.classList.remove('hidden');
                previewText.textContent = 'Image preview loaded successfully';
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
            noPreview.classList.remove('hidden');
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
    document.getElementById('description').addEventListener('input', function() {
        const charCount = this.value.length;
        const counter = document.getElementById('charCounter') || (function() {
            const counter = document.createElement('div');
            counter.id = 'charCounter';
            counter.className = 'text-sm text-gray-500 mt-1';
            this.parentNode.appendChild(counter);
            return counter;
        }).call(this);
        
        counter.textContent = `${charCount} characters`;
        
        if (charCount > 500) {
            counter.className = 'text-sm text-red-600 mt-1';
        } else if (charCount > 300) {
            counter.className = 'text-sm text-yellow-600 mt-1';
        } else {
            counter.className = 'text-sm text-gray-500 mt-1';
        }
    });
</script>
@endpush
@endsection