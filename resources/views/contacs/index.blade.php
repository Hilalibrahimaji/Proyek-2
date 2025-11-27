@extends('layouts.main')

@section('title', 'Contact Us - VHGH')

@section('content')
<!-- Contact Header -->
<section class="bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Contact Us</h1>
        <p class="text-gray-600">Get in touch with us. We'd love to hear from you!</p>
    </div>
</section>

<!-- Contact Section -->
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
            <!-- Contact Information -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Get In Touch</h2>
                
                <div class="space-y-6">
                    <!-- Address -->
                    <div class="flex items-start space-x-4">
                        <div class="bg-[#10a2a2] text-white p-3 rounded-lg">
                            <i class="fas fa-map-marker-alt text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-1">Our Address</h3>
                            <p class="text-gray-600">123 Anime Street, Akihabara<br>Tokyo 101-0021, Japan</p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex items-start space-x-4">
                        <div class="bg-[#10a2a2] text-white p-3 rounded-lg">
                            <i class="fas fa-phone text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-1">Phone Number</h3>
                            <p class="text-gray-600">+81 3-1234-5678</p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start space-x-4">
                        <div class="bg-[#10a2a2] text-white p-3 rounded-lg">
                            <i class="fas fa-envelope text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-1">Email Address</h3>
                            <p class="text-gray-600">info@vhgh.com<br>support@vhgh.com</p>
                        </div>
                    </div>

                    <!-- Business Hours -->
                    <div class="flex items-start space-x-4">
                        <div class="bg-[#10a2a2] text-white p-3 rounded-lg">
                            <i class="fas fa-clock text-lg"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-1">Business Hours</h3>
                            <p class="text-gray-600">
                                Monday - Friday: 9:00 AM - 6:00 PM JST<br>
                                Saturday: 10:00 AM - 4:00 PM JST<br>
                                Sunday: Closed
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="mt-8">
                    <h3 class="font-semibold text-gray-800 mb-4">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="bg-gray-800 text-white p-3 rounded-lg hover:bg-gray-700 transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="bg-gray-800 text-white p-3 rounded-lg hover:bg-gray-700 transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="bg-gray-800 text-white p-3 rounded-lg hover:bg-gray-700 transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="bg-gray-800 text-white p-3 rounded-lg hover:bg-gray-700 transition duration-300">
                            <i class="fab fa-discord"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Send us a Message</h2>
                
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300"
                                   placeholder="Your full name">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300"
                                   placeholder="your.email@example.com">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Subject -->
                    <div class="mb-4">
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300"
                               placeholder="What is this regarding?">
                        @error('subject')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Message -->
                    <div class="mb-6">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                        <textarea id="message" name="message" rows="6" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-[#10a2a2] transition duration-300"
                                  placeholder="Tell us how we can help you...">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-center">
    <button class="w-full sm:w-auto bg-gray-800 hover:bg-green-600 text-white font-semibold rounded-lg transition duration-300 px-10 py-3 max-w-sm flex items-center justify-center gap-2">
        <i class="fas fa-sign-in-alt"></i>
        Send Message
    </button>
</div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Frequently Asked Questions</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            <!-- FAQ Items -->
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <h3 class="font-semibold text-gray-800 mb-2">Do you ship internationally?</h3>
                <p class="text-gray-600">Yes, we ship worldwide! Shipping costs and delivery times vary by location.</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <h3 class="font-semibold text-gray-800 mb-2">What is your return policy?</h3>
                <p class="text-gray-600">We offer 30-day returns for unused items in original packaging.</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <h3 class="font-semibold text-gray-800 mb-2">Are your products official merchandise?</h3>
                <p class="text-gray-600">Yes, all our products are 100% official licensed merchandise.</p>
            </div>
            
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <h3 class="font-semibold text-gray-800 mb-2">How can I track my order?</h3>
                <p class="text-gray-600">You'll receive a tracking number via email once your order ships.</p>
            </div>
        </div>
    </div>
</section>
@endsection