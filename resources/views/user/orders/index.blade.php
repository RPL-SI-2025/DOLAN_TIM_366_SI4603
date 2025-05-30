<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <x-navbar />
    
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">My Orders</h1>
                <p class="text-gray-600">Track and manage your orders</p>
            </div>
            <div class="mb-6">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <a href="{{ route('user.orders') }}?type=all" 
                           class="py-2 px-1 border-b-2 font-medium text-sm {{ $type === 'all' ? 'border-purple-500 text-purple-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            All Orders
                        </a>
                        <a href="{{ route('user.orders') }}?type=ticket" 
                           class="py-2 px-1 border-b-2 font-medium text-sm {{ $type === 'ticket' ? 'border-purple-500 text-purple-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Tickets
                        </a>
                        <a href="{{ route('user.orders') }}?type=merchandise" 
                           class="py-2 px-1 border-b-2 font-medium text-sm {{ $type === 'merchandise' ? 'border-purple-500 text-purple-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Merchandise
                        </a>
                    </nav>
                </div>
            </div>
            @if($orders->count() > 0)
                <div class="space-y-4">
                    @foreach($orders as $order)
                        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            Order #{{ $order->id }}
                                        </h3>
                                        <p class="text-sm text-gray-500">
                                            {{ $order->created_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="px-3 py-1 rounded-full text-xs font-medium
                                            {{ $order->status === 'completed' ? 'bg-green-300 text-green-800' : 
                                               ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                                'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                        <span class="px-2 py-1 rounded text-xs font-medium bg-purple-100 text-purple-800">
                                            {{ $order->product_type === 'App\\Models\\Ticket' ? 'Ticket' : 'Merchandise' }}
                                        </span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="md:col-span-2">
                                        <div class="flex items-start space-x-4">
                                            @if($order->product_type === 'App\\Models\\Ticket' && $order->product->destination && $order->product->destination->image)
                                                <img src="{{ asset($order->product->destination->image) }}" 
                                                     alt="Destination" 
                                                     class="w-16 h-16 rounded-lg object-cover">
                                            @endif
                                            
                                            <div class="flex-1">
                                                <h4 class="font-medium text-gray-900">
                                                    @if($order->product_type === 'App\\Models\\Ticket')
                                                        {{ $order->product->ticket_name }}
                                                        @if($order->product->destination)
                                                            <br><span class="text-sm text-gray-500">{{ $order->product->destination->name }}</span>
                                                        @endif
                                                    @else
                                                        {{ $order->product->name }}
                                                    @endif
                                                </h4>
                                                <p class="text-sm text-gray-500 mt-1">
                                                    Quantity: {{ $order->quantity }}
                                                </p>
                                                @if($order->product_type === 'App\\Models\\Ticket' && $order->product->ticket_date)
                                                    <p class="text-sm text-gray-500">
                                                        Date: {{ $order->product->ticket_date->format('d M Y') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-lg font-bold text-gray-900 mb-3">
                                            IDR {{ number_format($order->total_amount, 0, ',', '.') }}
                                        </p>
                                        
                                        <div class="space-y-2">
                                            <a href="{{ route('user.orders.show', $order->id) }}" 
                                               class="inline-block w-full text-center px-4 py-2 text-purple-600 hover:text-purple-800 border border-purple-600 hover:border-purple-800 rounded-lg text-sm font-medium transition-colors">
                                                View Details
                                            </a>
                                            @if($order->status === 'pending')
                                                <a href="{{ route('payment.checkout', $order->id) }}" 
                                                   class="inline-block w-full text-center px-4 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white rounded-lg text-sm font-medium transition-all transform hover:scale-105">
                                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                                    </svg>
                                                    Pay Now
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if($order->status === 'pending')
                                    <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                            </svg>
                                            <p class="text-yellow-800 text-sm">
                                                <span class="font-medium">Payment Required:</span> Complete your payment to confirm this order.
                                            </p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $orders->appends(['type' => $type])->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No orders found</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        @if($type === 'ticket')
                            You haven't ordered any tickets yet.
                        @elseif($type === 'merchandise')
                            You haven't ordered any merchandise yet.
                        @else
                            You haven't placed any orders yet.
                        @endif
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('home') }}" 
                           class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700">
                            Start Shopping
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</body>
</html>