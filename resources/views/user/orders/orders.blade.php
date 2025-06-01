<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details #{{ $order->id }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <x-navbar />
    
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <a href="{{ route('user.orders') }}" 
                   class="inline-flex items-center text-purple-600 hover:text-purple-800">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to Orders
                </a>
            </div>
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-2xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
                    <span class="px-4 py-2 rounded-full text-sm font-medium
                        {{ $order->status === 'completed' ? 'bg-green-300 text-green-800' : 
                           ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                            'bg-red-100 text-red-800') }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">Order Date:</span>
                        <p class="font-medium">{{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Product Type:</span>
                        <p class="font-medium">{{ $order->product_type === 'App\\Models\\Ticket' ? 'Ticket' : 'Merchandise' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Quantity:</span>
                        <p class="font-medium">{{ $order->quantity }}</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Total Amount:</span>
                        <p class="font-medium text-lg">IDR {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Product Details</h2>
                
                <div class="flex items-start space-x-6">
                    @if($order->product_type === 'App\\Models\\Ticket' && $order->product->destination && $order->product->destination->image)
                        <img src="{{ asset($order->product->destination->image) }}" 
                             alt="Destination" 
                             class="w-32 h-32 rounded-lg object-cover">
                    @endif
                    
                    <div class="flex-1">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">
                            @if($order->product_type === 'App\\Models\\Ticket')
                                {{ $order->product->ticket_name }}
                            @else
                                {{ $order->product->name }}
                            @endif
                        </h3>
                        
                        @if($order->product_type === 'App\\Models\\Ticket')
                            @if($order->product->destination)
                                <p class="text-gray-600 mb-2">
                                    <span class="font-medium">Destination:</span> {{ $order->product->destination->name }}
                                </p>
                                <p class="text-gray-600 mb-2">
                                    <span class="font-medium">Location:</span> {{ $order->product->destination->location }}
                                </p>
                            @endif
                            
                            @if($order->product->ticket_date)
                                <p class="text-gray-600 mb-2">
                                    <span class="font-medium">Valid Date:</span> {{ $order->product->ticket_date->format('d M Y') }}
                                </p>
                            @endif
                        @endif
                        
                        <p class="text-gray-600 mb-2">
                            <span class="font-medium">Price per item:</span> IDR {{ number_format($order->product->price, 0, ',', '.') }}
                        </p>
                        
                        <p class="text-gray-600">
                            <span class="font-medium">Quantity:</span> {{ $order->quantity }}
                        </p>
                        <p class="text-gray-600">
                            <span class="font-medium">Belongs to:</span> {{ $order->user->name }}
                    </div>
                </div>
            </div>
            @if($order->status === 'completed')
                <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-green-800 font-medium">Payment completed successfully!</p>
                    </div>
                </div>
            @elseif($order->status === 'pending')
                <div class="mt-6 space-y-4">
                    <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-yellow-400 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <div class="flex-1">
                                <p class="text-yellow-800 font-medium">Payment is pending</p>
                                <p class="text-yellow-600 text-sm mt-1">Your order is waiting for payment completion. Click the button below to continue with your payment.</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                        <div class="text-center">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Complete Your Payment</h3>
                            <p class="text-gray-600 mb-4">Click the button below to proceed with your payment</p>
                            
                            <a href="{{ route('payment.checkout', $order->id) }}" 
                               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg transform transition duration-200 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-purple-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                                Pay Now - IDR {{ number_format($order->total_amount, 0, ',', '.') }}
                            </a>
                            
                            <div class="mt-4 text-sm text-gray-500">
                                <p>Secure payment powered by Midtrans</p>
                                <div class="flex justify-center space-x-2 mt-2 opacity-60">
                                    <span class="bg-gray-100 px-2 py-1 rounded text-xs">Credit Card</span>
                                    <span class="bg-gray-100 px-2 py-1 rounded text-xs">Bank Transfer</span>
                                    <span class="bg-gray-100 px-2 py-1 rounded text-xs">E-Wallet</span>
                                    <span class="bg-gray-100 px-2 py-1 rounded text-xs">QRIS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="mt-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-red-800 font-medium">Payment was cancelled or failed.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>
</html>