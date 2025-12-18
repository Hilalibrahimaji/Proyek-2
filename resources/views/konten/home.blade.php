@extends('layouts.main')

@section('title', 'Home - VHGH')

@section('content')
    <!-- Hero Section -->
    <section class="bg-white py-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <!-- Teks di Sebelah Kiri -->
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">
                        New Inspiration <span class="text-gray-600">2025</span>
                    </h1>
                    <div class="text-2xl md:text-3xl font-semibold text-gray-700 mb-4">
                        VHGH MADE FOR YOU!
                    </div>
                    <p class="text-lg text-gray-600 mb-8">
                        To Become A Better Wibu! Discover amazing anime merchandise and collectibles that will level up your wibu journey.
                    </p>
                    
                    @auth
                        <a href="{{ route('products') }}" 
                        class="bg-purple-600 text-white px-8 py-3 rounded-full font-semibold text-lg hover:bg-purple-700 transition duration-300 inline-block transform hover:scale-105">
                            SHOP NOW
                        </a>
                    @else
                        <div class="space-y-4">
                            <p class="text-red-500 font-semibold">
                                <i class="fas fa-lock mr-2"></i>Please login to view and purchase products
                            </p>
                            <div class="flex space-x-4">
                                <a href="{{ route('login') }}" 
                                class="bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-700 transition duration-300">
                                    LOGIN
                                </a>
                                <a href="{{ route('register') }}" 
                                class="bg-gray-800 text-white px-6 py-3 rounded-lg font-semibold hover:bg-gray-900 transition duration-300">
                                    REGISTER
                                </a>
                            </div>
                        </div>
                    @endauth
                </div>
                
                <!-- Gambar di Sebelah Kanan -->
                <div class="md:w-1/2">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1578632749014-ca77efd052eb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" 
                            alt="Anime Collection" 
                            class="rounded-lg shadow-2xl transform hover:scale-105 transition duration-300">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Why Choose VHGH?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6 rounded-lg hover:shadow-lg transition duration-300">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shipping-fast text-purple-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Fast Shipping</h3>
                    <p class="text-gray-600">Free shipping on orders over $50</p>
                </div>
                
                <div class="text-center p-6 rounded-lg hover:shadow-lg transition duration-300">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Secure Payment</h3>
                    <p class="text-gray-600">100% secure payment processing</p>
                </div>
                
                <div class="text-center p-6 rounded-lg hover:shadow-lg transition duration-300">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">24/7 Support</h3>
                    <p class="text-gray-600">Always here to help you</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Preview Section (Hanya show jika login) -->
    @auth
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Featured Products</h2>
                <a href="{{ route('products') }}" class="text-purple-600 hover:text-purple-700 font-semibold">
                    View All <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Sample Product Cards -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <img src="https://images.unsplash.com/photo-1545569341-9eb8b30979d9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                        alt="Product" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold mb-2">Anime Figure - Character A</h3>
                        <p class="text-purple-600 font-bold text-lg">$29.99</p>
                        <button class="mt-3 bg-purple-600 text-white px-4 py-2 rounded-lg w-full hover:bg-purple-700 transition duration-300">
                            Add to Cart
                        </button>
                    </div>
                </div>
                <!-- Add more product cards as needed -->
            </div>
        </div>
    </section>
    @else
    <!-- Login Prompt Section -->
    <section class="py-16 bg-purple-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Ready to Start Your Wibu Journey?</h2>
            <p class="text-xl mb-8">Login or register to explore our amazing collection of anime merchandise!</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('login') }}" 
                class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                    LOGIN NOW
                </a>
                <a href="{{ route('register') }}" 
                class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition duration-300">
                    REGISTER
                </a>
            </div>
        </div>
    </section>
    @endauth
@endsection