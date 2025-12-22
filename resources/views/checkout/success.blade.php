@extends('layouts.main')

@section('title', 'Order Success - VHGH')

@section('content')
<section class="min-h-screen bg-gray-50 flex items-center py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check text-green-600 text-2xl"></i>
                </div>
                
                <h1 class="text-3xl font-bold text-gray-800 mb-4">Order Successful!</h1>
                
                @if(session('order_number'))
                <p class="text-lg text-gray-600 mb-2">
                    Your order <span class="font-semibold text-[#10a2a2]">{{ session('order_number') }}</span> has been placed successfully.
                </p>
                @endif
                
                <p class="text-gray-600 mb-8">
                    Thank you for your purchase! We've sent a confirmation email to your registered email address.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <i class="fas fa-envelope text-[#10a2a2] text-xl mb-2"></i>
                        <p class="text-sm text-gray-600">Confirmation Email Sent</p>
                    </div>
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <i class="fas fa-shipping-fast text-[#10a2a2] text-xl mb-2"></i>
                        <p class="text-sm text-gray-600">Processing Your Order</p>
                    </div>
                    <div class="text-center p-4 bg-gray-50 rounded-lg">
                        <i class="fas fa-clock text-[#10a2a2] text-xl mb-2"></i>
                        <p class="text-sm text-gray-600">Delivery in 3-5 Days</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('home') }}" 
                       class="bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-900 transition duration-300">
                        Back to Home
                    </a>
                    <a href="{{ route('orders.show', $order->order_number) }}" 
                       class="bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-900 transition duration-300">
                        View Order
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection