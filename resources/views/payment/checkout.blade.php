<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment | 
    @if($order->product_type === 'App\\Models\\Ticket')
        {{ $order->product->ticket_name }}
    @elseif($order->product_type === 'App\\Models\\Merch')
        {{ $order->product->name }}
    @else
        Product
    @endif
</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    .gradient-bg {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
  </style>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
<x-navbar />

<div class="min-h-screen py-8 px-4">
    <div class="max-w-2xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('home') }}" 
               class="inline-flex items-center text-purple-600 hover:text-purple-800 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Home
            </a>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header with Gradient -->
            <div class="gradient-bg p-8 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                        <h1 class="text-3xl md:text-4xl font-bold mb-2">Complete Payment</h1>
                        <p class="text-purple-100 text-lg">Almost there! Review your order and pay securely</p>
                    </div>
                </div>
                <!-- Background Pattern -->
                <div class="absolute top-0 right-0 w-64 h-64 opacity-10">
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" d="M45.1,-51.4C59.2,-40.1,71.4,-26.3,77.3,-8.8C83.1,8.6,82.6,29.8,73.6,45.1C64.6,60.4,47.1,69.8,28.5,75.9C9.9,82,-9.8,84.8,-28.6,79.9C-47.4,75,-65.3,62.4,-76.6,44.8C-87.9,27.2,-92.6,4.6,-89.7,-16.3C-86.8,-37.2,-76.3,-56.4,-60.4,-67.2C-44.5,-78,-23.2,-80.4,-2.8,-76.8C17.6,-73.1,31,-64.7,45.1,-51.4Z" transform="translate(100 100)" />
                    </svg>
                </div>
            </div>

            <div class="p-8">
                <!-- Order Summary Section -->
                <div class="space-y-6">
                    <!-- Order ID Card -->
                    <div class="bg-gradient-to-r from-purple-50 to-indigo-50 p-6 rounded-xl border border-purple-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Order Summary
                        </h3>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Order ID:</span>
                                <span class="font-semibold text-gray-900 bg-purple-100 px-3 py-1 rounded-full text-sm">#{{ $order->id }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Product Type:</span>
                                <span class="font-semibold text-gray-900">
                                    @if($order->product_type === 'App\\Models\\Ticket')
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Ticket</span>
                                    @elseif($order->product_type === 'App\\Models\\Merchandise')
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Merchandise</span>
                                    @else
                                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">Product</span>
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Product Name:</span>
                                <span class="font-semibold text-gray-900 text-right max-w-xs">
                                    @if($order->product_type === 'App\\Models\\Ticket')
                                        {{ $order->product->ticket_name }}
                                    @elseif($order->product_type === 'App\\Models\\Merchandise')
                                        {{ $order->product->name }}
                                    @else
                                        Unknown Product
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Quantity:</span>
                                <span class="font-semibold text-gray-900">{{ $order->quantity }} item(s)</span>
                            </div>
                            
                            <!-- Destination Info for Tickets -->
                            @if($order->product_type === 'App\\Models\\Ticket' && $order->product->destination)
                                <div class="flex justify-between items-start">
                                    <span class="text-gray-600">Destination:</span>
                                    <span class="font-semibold text-gray-900 text-right max-w-xs">{{ $order->product->destination->name }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Payment Amount Card -->
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-xl border border-green-100">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                            Payment Details
                        </h3>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Price per item:</span>
                                <span class="font-medium text-gray-900">IDR {{ number_format($order->total_amount / $order->quantity, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Quantity:</span>
                                <span class="font-medium text-gray-900">{{ $order->quantity }}</span>
                            </div>
                            
                            <hr class="border-gray-200">
                            
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">Total Amount:</span>
                                <span class="text-2xl font-bold text-green-600">IDR {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Button -->
                    <div class="space-y-4">
                        <button id="pay-button" 
                                class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg transform transition duration-200 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-purple-300 flex items-center justify-center">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Pay Now - IDR {{ number_format($order->total_amount, 0, ',', '.') }}
                        </button>

                        <!-- Payment Methods Info -->
                        <div class="text-center text-sm text-gray-500">
                            <p class="mb-2">We accept various payment methods</p>
                            <div class="flex justify-center space-x-3 opacity-60">
                                <span class="bg-gray-100 px-2 py-1 rounded text-xs">Credit Card</span>
                                <span class="bg-gray-100 px-2 py-1 rounded text-xs">Bank Transfer</span>
                                <span class="bg-gray-100 px-2 py-1 rounded text-xs">E-Wallet</span>
                                <span class="bg-gray-100 px-2 py-1 rounded text-xs">QRIS</span>
                            </div>
                        </div>
                    </div>

                    <!-- Security Notice -->
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-blue-800 font-medium">Secure Payment Guarantee</p>
                                <p class="text-xs text-blue-600 mt-1">Your payment information is encrypted and processed securely through Midtrans payment gateway.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Order Status Info -->
                    <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-yellow-800 font-medium">Order Status: Pending Payment</p>
                                <p class="text-xs text-yellow-600 mt-1">Your order will be confirmed immediately after successful payment. You can track your order status in your account.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Midtrans Snap JS --}}
<script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        // Add loading state
        const button = this;
        const originalText = button.innerHTML;
        button.innerHTML = `
            <svg class="animate-spin w-5 h-5 mr-3" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Processing...
        `;
        button.disabled = true;

        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                window.location.href = '{{ route("payment.finish", $order->id) }}?status=success&order_id=' + result.order_id;
            },
            onPending: function(result){
                window.location.href = '{{ route("payment.finish", $order->id) }}?status=pending&order_id=' + result.order_id;
            },
            onError: function(result){
                window.location.href = '{{ route("payment.finish", $order->id) }}?status=error&order_id=' + (result.order_id || '{{ $order->id }}');
            },
            onClose: function(){
                // Restore button state
                button.innerHTML = originalText;
                button.disabled = false;
                
                // Show friendly message
                const alertDiv = document.createElement('div');
                alertDiv.className = 'fixed top-4 right-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded shadow-lg z-50';
                alertDiv.innerHTML = `
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm">Payment cancelled. You can try again anytime.</p>
                        </div>
                        <div class="ml-auto pl-3">
                            <button onclick="this.parentElement.parentElement.parentElement.remove()" class="text-yellow-700 hover:text-yellow-900">
                                <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                `;
                document.body.appendChild(alertDiv);
                
                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (alertDiv.parentElement) {
                        alertDiv.remove();
                    }
                }, 5000);
            }
        });
    };
</script>
</body>
</html>