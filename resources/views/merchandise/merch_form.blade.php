<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Purchase {{ $merchandise->name }} | Dolan</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; }
    .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
  </style>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50">
<x-navbar />

<div class="min-h-screen py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('merchandise.show', $merchandise->id) }}" 
               class="inline-flex items-center text-purple-600 hover:text-purple-800 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Product Details
            </a>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Product Information -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Header -->
                <div class="gradient-bg p-8 text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-3xl md:text-4xl font-bold mb-2">Purchase Merchandise</h1>
                                <p class="text-purple-100 text-lg">Complete your order for exclusive merchandise</p>
                            </div>
                            <div class="hidden md:block">
                                <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="p-8">
                    <div class="flex items-start space-x-6">
                        @if($merchandise->image)
                            <img src="{{ asset('storage/' . $merchandise->image) }}" 
                                 alt="{{ $merchandise->name }}" 
                                 class="w-32 h-32 rounded-lg object-cover shadow-md">
                        @endif
                        
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $merchandise->name }}</h2>
                            <div class="flex items-center text-gray-600 mb-3">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $merchandise->location }}
                            </div>
                            @if($merchandise->detail)
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($merchandise->detail, 150) }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Price and Stock Info -->
                    <div class="bg-purple-50 p-6 rounded-xl border border-purple-100 mt-6">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-gray-600">Price per item:</span>
                            <span class="text-2xl font-bold text-purple-600">
                                IDR {{ number_format($merchandise->price, 0, ',', '.') }}
                            </span>
                        </div>
                        
                        <!-- Stock Status -->
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Stock Available:</span>
                            <div class="flex items-center">
                                <span class="text-blue-900 font-bold text-lg mr-2">{{ number_format($merchandise->stock) }}</span>
                                <span class="px-2 py-1 text-xs rounded-full
                                    {{ $merchandise->stock <= 0 ? 'bg-red-100 text-red-800' : 
                                       ($merchandise->stock <= 5 ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                    {{ $merchandise->stock_status }}
                                </span>
                            </div>
                        </div>
                        @if($merchandise->stock <= 5 && $merchandise->stock > 0)
                            <p class="text-yellow-700 text-sm mt-2">Limited stock available! Order now before it's sold out.</p>
                        @elseif($merchandise->stock <= 0)
                            <p class="text-red-700 text-sm mt-2">Sorry, this merchandise is currently out of stock.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Purchase Form -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                @if($merchandise->stock > 0)
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Complete Your Order
                        </h3>

                        @if(session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('merchandise.purchase', $merchandise->id) }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <!-- Quantity Selection -->
                            <div>
                                <label for="quantity" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Select Quantity
                                </label>
                                <div class="relative">
                                    <input type="number" 
                                           id="quantity" 
                                           name="quantity" 
                                           value="{{ old('quantity', 1) }}" 
                                           min="1" 
                                           max="{{ min(10, $merchandise->stock) }}"
                                           {{ $merchandise->stock <= 0 ? 'disabled' : '' }}
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-lg font-semibold {{ $merchandise->stock <= 0 ? 'bg-gray-100' : '' }}"
                                           onchange="updateTotal()">
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                        </svg>
                                    </div>
                                </div>
                                @error('quantity')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Size Selection -->
                            @if($merchandise->sizes_array && count($merchandise->sizes_array) > 0)
                                <div>
                                    <label for="size" class="block text-sm font-semibold text-gray-700 mb-2">
                                        Select Size (Optional)
                                    </label>
                                    <select id="size" 
                                            name="size" 
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                                        <option value="">Choose a size</option>
                                        @foreach($merchandise->sizes_array as $size)
                                            @if(trim($size) !== '' && trim($size) !== '-')
                                                <option value="{{ trim($size) }}" {{ old('size') == trim($size) ? 'selected' : '' }}>
                                                    {{ trim($size) }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('size')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            @endif

                            <!-- Total Price Display -->
                            <div class="bg-gray-50 p-4 rounded-lg border">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600 font-medium">Total Amount:</span>
                                    <span id="total-price" class="text-2xl font-bold text-purple-600">
                                        IDR {{ number_format($merchandise->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" 
                                    {{ $merchandise->stock <= 0 ? 'disabled' : '' }}
                                    class="w-full px-8 py-4 {{ $merchandise->stock <= 0 ? 'bg-gray-400 cursor-not-allowed' : 'bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700' }} text-white font-bold rounded-xl shadow-lg transform transition duration-200 {{ $merchandise->stock > 0 ? 'hover:scale-105' : '' }} focus:outline-none focus:ring-4 focus:ring-purple-300 flex items-center justify-center">
                                @if($merchandise->stock <= 0)
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                                    </svg>
                                    Out of Stock
                                @else
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                    </svg>
                                    Purchase Now - {{ number_format($merchandise->stock) }} Available
                                @endif
                            </button>
                        </form>
                    </div>

                    <!-- Security Notice -->
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200 mx-8 mb-8">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <div>
                                <p class="text-sm text-blue-800 font-medium">Secure Payment</p>
                                <p class="text-xs text-blue-600 mt-1">Your payment is processed securely through our trusted payment gateway.</p>
                            </div>
                        </div>
                    </div>
                @else 
                    <!-- No Stock Available -->
                    <div class="text-center py-12">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                        </svg>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Out of Stock</h3>
                        <p class="text-gray-600 mb-6">This merchandise is currently unavailable.</p>
                        
                        @auth
                        <div class="space-y-3">
                            <a href="{{ route('merchandise.index') }}" 
                               class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Browse Other Merchandise
                            </a>
                        </div>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function updateTotal() {
    const quantity = document.getElementById('quantity').value;
    const price = parseFloat('{{ $merchandise->price }}');
    const total = quantity * price;
    
    document.getElementById('total-price').textContent = 
        'IDR ' + total.toLocaleString('id-ID');
}

// Initialize total on page load
document.addEventListener('DOMContentLoaded', function() {
    updateTotal();
});
</script>
</body>
</html>