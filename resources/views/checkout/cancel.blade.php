@extends('layouts.main')

@section('title', 'Order Cancelled - VHGH')

@section('content')
<!-- Cancel Header -->
<section class="bg-red-50 py-8">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Order Cancelled</h1>
            <p class="text-gray-600">Your payment was not completed</p>
        </div>
    </div>
</section>

<!-- Cancel Content -->
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <!-- Cancel Icon -->
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-times text-red-600 text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Payment Cancelled</h2>
                    <p class="text-gray-600">Your order was not completed. No charges were made.</p>
                </div>

                <!-- Reasons -->
                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Why was my order cancelled?</h3>
                    
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <i class="fas fa-clock text-red-600 mt-1 mr-3"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Payment Timeout</p>
                                <p class="text-sm text-gray-600">The payment session expired before completion.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-ban text-red-600 mt-1 mr-3"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Payment Declined</p>
                                <p class="text-sm text-gray-600">Your payment method was declined by the bank.</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-user text-red-600 mt-1 mr-3"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Manual Cancellation</p>
                                <p class="text-sm text-gray-600">You chose to cancel the payment process.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">What can you do now?</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="text-center p-4 bg-blue-50 rounded-lg">
                            <i class="fas fa-redo text-blue-600 text-xl mb-2"></i>
                            <p class="text-sm font-semibold text-gray-800">Try Again</p>
                            <p class="text-xs text-gray-600 mt-1">Retry your purchase with the same items</p>
                        </div>
                        <div class="text-center p-4 bg-green-50 rounded-lg">
                            <i class="fas fa-credit-card text-green-600 text-xl mb-2"></i>
                            <p class="text-sm font-semibold text-gray-800">Different Payment</p>
                            <p class="text-xs text-gray-600 mt-1">Use another payment method</p>
                        </div>
                    </div>
                </div>

                <!-- Support Info -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-8">
                    <div class="flex items-start">
                        <i class="fas fa-question-circle text-yellow-600 mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-semibold text-yellow-800 mb-1">Need Assistance?</h4>
                            <p class="text-yellow-700 text-sm">
                                If you're experiencing issues with payments, contact our support team at 
                                <a href="mailto:support@vhgh.com" class="underline">support@vhgh.com</a>.
                                We're here to help!
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('cart') }}" 
                       class="bg-[#10a2a2] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#0d8c8c] transition duration-300 flex items-center justify-center">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Back to Cart
                    </a>
                    <a href="{{ route('products') }}" 
                       class="bg-gray-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-gray-900 transition duration-300 flex items-center justify-center">
                        <i class="fas fa-store mr-2"></i>
                        Continue Shopping
                    </a>
                </div>

                <!-- Security Note -->
                <div class="text-center mt-6 p-4 bg-green-50 rounded-lg">
                    <i class="fas fa-shield-alt text-green-600 mr-2"></i>
                    <span class="text-sm text-green-800">
                        <strong>Security Note:</strong> No payment information was stored during this process.
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection