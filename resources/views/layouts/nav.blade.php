<!-- Header -->
<header class="bg-white sticky top-0 z-50 shadow-sm">
    <nav class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">

            <!-- Logo -->
            <div class="flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-store mr-2 text-black"></i>
                    VHGH
                </a>

                <!-- Navigation Links -->
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">HOME</a>
                    <a href="{{ route('products') }}" class="nav-link {{ request()->routeIs('products') ? 'active' : '' }}">PRODUCT</a>
                    <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">ABOUT</a>
                    <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">CONTACT</a>
                </div>
            </div>

            <!-- Right Section -->
            <div class="flex items-center space-x-4">

                <!-- Search -->
                @auth
                    @if(!auth()->user()->isAdmin())
                        <div class="hidden md:block">
                            <form action="{{ route('products.search') }}" method="GET" class="relative">
                                <input type="text" name="q" placeholder="Search products..."
                                    class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#10a2a2] w-64">
                                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                            </form>
                        </div>
                    @endif
                @endauth

                <!-- Cart -->
                @auth
                    @if(!auth()->user()->isAdmin())
                        <a href="{{ route('cart') }}" class="text-gray-600 hover:text-gray-900 relative">
                            <i class="fas fa-shopping-cart text-xl"></i>
                            <span class="absolute -top-2 -right-2 bg-purple-600 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center">
                                {{ auth()->user()->cart_count ?? 0 }}
                            </span>
                        </a>
                    @endif
                @endauth

                <!-- Auth Section -->
                @auth
                    <!-- Dropdown Profile -->
                    <div class="relative" x-data="{ open: false }">
                        
                        <!-- Trigger Button -->
                        <button @click="open = !open"
                            class="flex items-center space-x-2 text-gray-600 hover:text-gray-900">

                            <div class="w-8 h-8 bg-[#10a2a2] rounded-full flex items-center justify-center text-white">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>

                            <span class="hidden md:block">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open"
                             x-cloak
                             @click.away="open = false"
                             x-transition
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">

                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                                    <i class="fas fa-tachometer-alt mr-2"></i> Admin Dashboard
                                </a>
                            @else
                                <a href="{{ route('profile') }}" class="dropdown-item">
                                    <i class="fas fa-user mr-2"></i> Profile
                                </a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item w-full text-left">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>

                @else
                    <a href="{{ route('login') }}" class="nav-link">LOGIN</a>
                    <a href="{{ route('register') }}" class="nav-link">REGISTER</a>
                @endauth
                <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

            </div>
        </div>
    </nav>
</header>

<!-- Tailwind Helpers -->
<style>
    [x-cloak] { display: none !important; }

    .nav-link {
        @apply text-gray-600 hover:text-gray-900 transition duration-300;
    }
    .nav-link.active {
        @apply font-semibold text-gray-900 border-b-2 border-purple-600;
    }
    .dropdown-item {
        @apply block px-4 py-2 text-gray-600 hover:bg-gray-100 transition;
    }
</style>
