@extends('layouts.main')

@section('title', 'About Us - VHGH')

@section('content')
<!-- About Header -->
<section class="bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">About VHGH</h1>
                <p class="text-gray-600">Learn more about our mission to serve the wibu community</p>
            </div>
            <div class="text-sm text-gray-500">
                <a href="{{ route('home') }}" class="text-[#10a2a2] hover:text-[#0d8c8c] transition duration-300">Home</a> 
                <span class="mx-2">/</span> 
                <span class="text-gray-400">About</span>
            </div>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Content -->
            <div>
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Our Story</h2>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    VHGH was founded in 2025 with a simple mission: to help anime and manga enthusiasts 
                    become better wibu through high-quality products and exceptional service.
                </p>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    We believe that every wibu deserves access to the best merchandise, from limited edition 
                    figures to comfortable apparel and unique collectibles. Our team is passionate about 
                    anime culture and dedicated to bringing you authentic, high-quality products.
                </p>

                <!-- Mission & Vision -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="w-12 h-12 bg-[#10a2a2] rounded-full flex items-center justify-center text-white mb-4">
                            <i class="fas fa-bullseye text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Our Mission</h3>
                        <p class="text-gray-600">
                            To provide authentic, high-quality anime merchandise that brings joy to every wibu's collection.
                        </p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="w-12 h-12 bg-[#10a2a2] rounded-full flex items-center justify-center text-white mb-4">
                            <i class="fas fa-eye text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Our Vision</h3>
                        <p class="text-gray-600">
                            To become the most trusted destination for anime enthusiasts worldwide.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Image -->
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1578632749014-ca77efd052eb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                     alt="Anime Collection" 
                     class="rounded-lg shadow-2xl">
                <div class="absolute -bottom-6 -left-6 bg-[#10a2a2] text-white px-6 py-3 rounded-lg shadow-lg">
                    <p class="font-bold text-lg">Since 2025</p>
                    <p class="text-sm">Serving the Wibu Community</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Our Values</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                The principles that guide everything we do at VHGH
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Value 1 -->
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-[#10a2a2] rounded-full flex items-center justify-center text-white mx-auto mb-4">
                    <i class="fas fa-shield-alt text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Authenticity</h3>
                <p class="text-gray-600">
                    We guarantee all our products are 100% authentic and officially licensed. 
                    No bootlegs, no compromises.
                </p>
            </div>

            <!-- Value 2 -->
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-[#10a2a2] rounded-full flex items-center justify-center text-white mx-auto mb-4">
                    <i class="fas fa-heart text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Passion</h3>
                <p class="text-gray-600">
                    We're wibu ourselves. We understand what matters to the community and 
                    share your passion for anime culture.
                </p>
            </div>

            <!-- Value 3 -->
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-[#10a2a2] rounded-full flex items-center justify-center text-white mx-auto mb-4">
                    <i class="fas fa-award text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">Quality</h3>
                <p class="text-gray-600">
                    Every product is carefully selected and inspected to meet our high standards 
                    of quality and craftsmanship.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Why Choose VHGH?</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                What makes us different from other anime merchandise stores
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Feature 1 -->
            <div class="text-center p-6 bg-gray-50 rounded-lg hover:shadow-lg transition duration-300">
                <i class="fas fa-shipping-fast text-[#10a2a2] text-3xl mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Fast Shipping</h3>
                <p class="text-gray-600 text-sm">
                    Free shipping on orders over $50. Worldwide delivery available.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="text-center p-6 bg-gray-50 rounded-lg hover:shadow-lg transition duration-300">
                <i class="fas fa-shield-alt text-[#10a2a2] text-3xl mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Secure Payment</h3>
                <p class="text-gray-600 text-sm">
                    100% secure payment processing with multiple payment options.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="text-center p-6 bg-gray-50 rounded-lg hover:shadow-lg transition duration-300">
                <i class="fas fa-headset text-[#10a2a2] text-3xl mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">24/7 Support</h3>
                <p class="text-gray-600 text-sm">
                    Our support team is always here to help you with any questions.
                </p>
            </div>

            <!-- Feature 4 -->
            <div class="text-center p-6 bg-gray-50 rounded-lg hover:shadow-lg transition duration-300">
                <i class="fas fa-undo text-[#10a2a2] text-3xl mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Easy Returns</h3>
                <p class="text-gray-600 text-sm">
                    30-day return policy. No questions asked.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-[#10a2a2] text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to Start Your Wibu Journey?</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto">
            Join thousands of satisfied customers who trust VHGH for their anime merchandise needs.
        </p>
        <div class="flex justify-center space-x-4">
            @auth
                <a href="{{ route('products') }}" 
                   class="bg-white text-[#10a2a2] px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                    Shop Now
                </a>
            @else
                <a href="{{ route('register') }}" 
                   class="bg-white text-[#10a2a2] px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300">
                    Join Now
                </a>
                <a href="{{ route('products') }}" 
                   class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-[#10a2a2] transition duration-300">
                    Browse Products
                </a>
            @endauth
        </div>
    </div>
</section>
@endsection