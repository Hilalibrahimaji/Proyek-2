@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
    <p class="text-gray-600">Welcome back, Administrator!</p>
</div>

<!-- Statistics Cards --><div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10 mb-10">


    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                <i class="fas fa-users text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600">Total Users</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalUsers }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                <i class="fas fa-box text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600">Total Products</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalProducts }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                <i class="fas fa-shopping-cart text-xl"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600">Total Orders</p>
                <p class="text-2xl font-bold text-gray-800">{{ $totalOrders }}</p>
            </div>
        </div>
    </div>

   
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Sales Chart -->
    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Monthly Sales</h3>
        <canvas id="salesChart" height="250"></canvas>
    </div>

    <!-- Revenue Chart -->
    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Monthly Revenue</h3>
        <canvas id="revenueChart" height="250"></canvas>
    </div>
</div>

<!-- Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent Users -->
    <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Recent Users</h3>
            <a href="{{ route('admin.users') }}" class="text-[#10a2a2] hover:text-[#0d8c8c] text-sm">View All</a>
        </div>
        <div class="space-y-3">
            @foreach($recentUsers as $user)
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-[#10a2a2] rounded-full flex items-center justify-center text-white text-sm font-bold mr-3">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-800">{{ $user->name }}</p>
                        <p class="text-xs text-gray-600">{{ $user->email }}</p>
                    </div>
                </div>
                <span class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Recent Products -->
    <!-- Recent Products -->
<div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Recent Products</h3>
        <a href="{{ route('admin.products') }}" class="text-[#10a2a2] hover:text-[#0d8c8c] text-sm">View All</a>
    </div>
    <div class="space-y-3">
        @isset($recentProducts)
            @foreach($recentProducts as $product)
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <div class="flex items-center">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-10 h-10 rounded object-cover mr-3">
                    <div>
                        <p class="text-sm font-medium text-gray-800">{{ Str::limit($product->name, 30) }}</p>
                        <p class="text-xs text-gray-600">${{ number_format($product->price, 2) }}</p>
                    </div>
                </div>
                <span class="text-xs px-2 py-1 rounded-full {{ $product->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $product->stock }} in stock
                </span>
            </div>
            @endforeach
        @else
            <div class="text-center py-4 text-gray-500">
                <i class="fas fa-box text-2xl mb-2"></i>
                <p class="text-sm">No recent products</p>
            </div>
        @endisset
    </div>
</div>
</div>

@push('scripts')
<script>
    // Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: @json($monthlySales['labels']),
            datasets: [{
                label: 'Sales',
                data: @json($monthlySales['data']),
                borderColor: '#10a2a2',
                backgroundColor: 'rgba(16, 162, 162, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'bar',
        data: {
            labels: @json($monthlySales['labels']),
            datasets: [{
                label: 'Revenue ($)',
                data: @json($monthlySales['revenue']),
                backgroundColor: '#10a2a2',
                borderColor: '#0d8c8c',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush
@endsection