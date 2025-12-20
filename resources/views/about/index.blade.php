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
                <h2 class="text-4xl font-bold text-gray-800 mb-6">Cerita Kami</h2>
              <p class="text-lg text-gray-600 mb-6 leading-relaxed text-left lg:text-justify">
    VHGH didirikan pada tahun 2025 dengan tujuan menghadirkan pakaian bertema anime
    yang berkualitas dan nyaman untuk digunakan sehari-hari.
</p>

<p class="text-lg text-gray-600 mb-8 leading-relaxed text-left lg:text-justify">
    Kami percaya bahwa kecintaan terhadap anime bisa diekspresikan melalui gaya berpakaian.
    Oleh karena itu, VHGH fokus menyediakan pakaian anime dengan desain eksklusif,
    bahan berkualitas, serta detail yang rapi agar tidak hanya keren secara visual,
    tetapi juga nyaman dipakai.
    <br><br>
    Setiap produk kami terinspirasi dari budaya anime dan dikembangkan untuk para penggemar
    yang ingin menampilkan identitas mereka dengan cara yang simpel namun stylish.
</p>


                <!-- Mission & Vision -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="w-12 h-12 bg-[#10a2a2] rounded-full flex items-center justify-center text-white mb-4">
                            <i class="fas fa-bullseye text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Misi Kami</h3>
                        <p class="text-gray-600 text-justify">
                        Menyediakan pakaian anime berkualitas tinggi dengan desain menarik, nyaman, dan terjangkau bagi para penggemar anime.ction.
                        </p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <div class="w-12 h-12 bg-[#10a2a2] rounded-full flex items-center justify-center text-white mb-4">
                            <i class="fas fa-eye text-xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-3">Visi Kami</h3>
                        <p class="text-gray-600 text-justify">
                           Menjadi brand pakaian anime terpercaya yang mampu menghadirkan produk berkualitas dan desain yang disukai oleh komunitas anime.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Image -->
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1578632749014-ca77efd052eb?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                     alt="Anime Collection" 
                     class="rounded-lg shadow-2xl">
              
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
               <div class="w-16 h-16 bg-[#10a2a2] rounded-full flex items-center justify-center mx-auto mb-4">
    <i class="fas fa-shield-alt text-2xl text-black"></i>
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
                    <i class="fas fa-heart text-2xl text-black"></i>
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
                    <i class="fas fa-award text-2xl text-black"></i>
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
<section class="py-16 bg-[#10a2a2] text-black">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Ready to Start Your Wibu Journey?</h2>
        <p class="text-xl mb-8 max-w-2xl mx-auto">
            Join thousands of satisfied customers who trust VHGH for their anime merchandise needs.
        </p>
        <div class="flex justify-center space-x-4">
            @auth
                <a href="{{ route('products') }}" 
                   class="bg-black text-white px-8 py-3 rounded-lg font-semibold hover:bg-black-100 transition duration-300">
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