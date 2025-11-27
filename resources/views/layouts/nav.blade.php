<!-- Header -->
<header class="bg-white sticky top-0 z-50">
    <nav class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <!-- Logo & Navigation -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-store mr-2 text-black-600"></i>
                    VHGH
                </a>
                
                <!-- Navigation Links - Desktop -->
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" 
                    class="text-gray-600 hover:text-gray-900 transition duration-300 {{ request()->routeIs('home') ? 'font-semibold text-gray-900 border-b-2 border-purple-600' : '' }}">
                        HOME
                    </a>
                    <a href="{{ route('products') }}" 
                    class="text-gray-600 hover:text-gray-900 transition duration-300 {{ request()->routeIs('products') ? 'font-semibold text-gray-900 border-b-2 border-purple-600' : '' }}">
                        PRODUCT
                    </a>
                    <a href="{{ route('about') }}" 
                    class="text-gray-600 hover:text-gray-900 transition duration-300 {{ request()->routeIs('about') ? 'font-semibold text-gray-900 border-b-2 border-purple-600' : '' }}">
                        ABOUT
                    </a>
                    <a href="{{ route('contact') }}" 
                    class="text-gray-600 hover:text-gray-900 transition duration-300 {{ request()->routeIs('contact') ? 'font-semibold text-gray-900 border-b-2 border-purple-600' : '' }}">
                        CONTACT
                    </a>
                </div>
            </div>
            
                <!-- Auth & Cart -->
<div class="flex items-center space-x-4">
    <!-- Search Bar -->
    @auth
        @if(!auth()->user()->isAdmin())
        <div class="hidden md:block">
            <form action="{{ route('products.search') }}" method="GET" class="relative">
                <input type="text" name="q" placeholder="Search products..." 
                       class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] focus:border-transparent w-64">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </form>
        </div>
        @endif
    @endauth
    
    <!-- Cart (hanya untuk user biasa) -->
    @auth
        @if(!auth()->user()->isAdmin())
        <a href="{{ route('cart') }}" class="text-gray-600 hover:text-gray-900 transition duration-300 relative">
            <i class="fas fa-shopping-cart text-xl"></i>
            <span class="absolute -top-2 -right-2 bg-purple-600 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center">
                {{ auth()->user()->cart_count ?? 0 }}
            </span>
        </a>
        @endif
    @endauth
    
    <!-- Auth Links -->
    <div class="flex items-center space-x-3">
        @auth
            <!-- Profile Dropdown untuk user yang sudah login -->
            <div class="relative group">
                <button class="flex items-center space-x-2 text-gray-600 hover:text-gray-900">
                    <div class="w-8 h-8 bg-[#10a2a2] rounded-full flex items-center justify-center text-white">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="hidden md:block">{{ auth()->user()->name }}</span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </button>
                
                <!-- Dropdown Menu -->
                <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block z-50">
                    @if(auth()->user()->isAdmin())
                        <!-- Menu untuk Admin -->
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-tachometer-alt mr-2"></i>Admin Dashboard
                        </a>
                    @else
                        <!-- Menu untuk User Biasa -->
                        <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-user mr-2"></i>Profile
                        </a>
                        <a href="{{ route('cart') }}" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-shopping-cart mr-2"></i>Cart
                        </a>
                    @endif
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-gray-600 hover:bg-gray-100">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- Untuk user yang belum login -->
            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 transition duration-300">
                <i class="fas fa-user mr-1"></i> LOGIN
            </a>
            <a href="{{ route('register') }}" class="text-gray-600 hover:text-gray-900 transition duration-300">
                <i class="fas fa-user-plus mr-1"></i> REGISTER
            </a>
        @endauth
    </div>
</div>
                </div>
            </div>
        </div>
        
        <!-- Mobile Menu -->
        <div class="md:hidden mt-4 space-y-2 hidden" id="mobile-menu">
            <a href="{{ route('home') }}" class="block py-2 text-gray-600 hover:text-gray-900">HOME</a>
            <a href="{{ route('products') }}" class="block py-2 text-gray-600 hover:text-gray-900">PRODUCT</a>
            <a href="{{ route('about') }}" class="block py-2 text-gray-600 hover:text-gray-900">ABOUT</a>
            <a href="{{ route('contact') }}" class="block py-2 text-gray-600 hover:text-gray-900">CONTACT</a>
        </div>
    </nav>
</header>

<script>
    // Mobile Menu Toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });
        }
    });
</script>