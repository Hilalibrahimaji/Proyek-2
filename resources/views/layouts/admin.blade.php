<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - VHGH | @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 font-sans">
    <!-- Admin Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-store mr-2 text-[#10a2a2]"></i>
                        VHGH <span class="text-sm font-normal text-gray-500 ml-2">Admin</span>
                    </a>
                    
                    <nav class="hidden md:flex space-x-6">
                        <a href="{{ route('admin.dashboard') }}" 
                        class="text-gray-600 hover:text-[#10a2a2] transition duration-300 {{ request()->routeIs('admin.dashboard') ? 'text-[#10a2a2] font-semibold' : '' }}">
                            <i class="fas fa-chart-bar mr-1"></i> Dashboard
                        </a>
                        <a href="{{ route('admin.users') }}" 
                        class="text-gray-600 hover:text-[#10a2a2] transition duration-300 {{ request()->routeIs('admin.users*') ? 'text-[#10a2a2] font-semibold' : '' }}">
                            <i class="fas fa-users mr-1"></i> Users
                        </a>
                        <a href="{{ route('admin.products') }}" 
                        class="text-gray-600 hover:text-[#10a2a2] transition duration-300 {{ request()->routeIs('admin.products*') ? 'text-[#10a2a2] font-semibold' : '' }}">
                            <i class="fas fa-box mr-1"></i> Products
                        </a>
                        <a href="{{ route('admin.contact.messages') }}" 
                        class="text-gray-600 hover:text-[#10a2a2] transition duration-300 {{ request()->routeIs('admin.contact.*') ? 'text-[#10a2a2] font-semibold' : '' }}">
                            <i class="fas fa-envelope mr-1"></i> Contact
    </a>
                    </nav>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-600 hover:text-[#10a2a2] transition duration-300" target="_blank">
                        <i class="fas fa-external-link-alt mr-1"></i> View Site
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-[#10a2a2] transition duration-300">
                            <i class="fas fa-sign-out-alt mr-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>