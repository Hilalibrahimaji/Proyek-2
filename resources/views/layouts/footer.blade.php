<!-- Footer -->
<footer class="bg-gray-800 text-white">
    <!-- Main Footer -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="col-span-1 md:col-span-2">
                <h3 class="text-2xl font-bold mb-4">VHGH</h3>
                <p class="text-gray-300 mb-4">
                    Your trusted partner in becoming a better wibu. Quality products for anime and manga enthusiasts.
                </p>
                <div class="flex space-x-4">
                   
                    <a href="https://www.instagram.com/vhigh.id?igsh=bHZjajg3cWRnMXho" class="text-gray-300 hover:text-white transition duration-300">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition duration-300">Home</a></li>
                    <li><a href="{{ route('products') }}" class="text-gray-300 hover:text-white transition duration-300">Products</a></li>
                    <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-white transition duration-300">About Us</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white transition duration-300">Contact</a></li>
                </ul>
            </div>
            
            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Contact Us</h4>
                <ul class="space-y-2 text-gray-300">
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Cirebon, Jawa Barat</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-phone"></i>
                        <span>+62 812-5645-9876</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-envelope"></i>
                        <span>info@vhgh.com</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Copyright -->
    <div class="border-t border-gray-700">
        <div class="container mx-auto px-4 py-4 text-center text-gray-300">
            <p>&copy; 2025 VHGH. All rights reserved. | Made for Wibu Community</p>
        </div>
    </div>
</footer>