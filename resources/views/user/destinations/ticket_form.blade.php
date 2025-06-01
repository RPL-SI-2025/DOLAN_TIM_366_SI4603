<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Your Ticket | {{ $destination->name }}</title>
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
    <div class="max-w-4xl mx-auto">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('destinations.show', $destination->id) }}" 
               class="inline-flex items-center text-purple-600 hover:text-purple-800 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back to Destination
            </a>
        </div>

        <!-- Main Content Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header with Gradient -->
            <div class="gradient-bg p-8 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl md:text-4xl font-bold mb-2">Book Your Ticket</h1>
                            <p class="text-purple-100 text-lg">Secure your spot at this amazing destination</p>
                        </div>
                        <div class="hidden md:block">
                            <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                            </div>
                        </div>
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
                <!-- Error Message -->
                @if(session('error'))
                    <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4 rounded-r-lg">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">
                                    <strong class="font-medium">Error!</strong> {{ session('error') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Destination Info Card -->
                <div class="mb-8 p-6 bg-gray-50 rounded-xl border border-gray-100">
                    <div class="flex items-start space-x-4">
                        @if($destination->image)
                            <img src="{{ asset($destination->image) }}" 
                                 alt="{{ $destination->name }}" 
                                 class="w-20 h-20 rounded-lg object-cover shadow-md">
                        @endif
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-gray-900 mb-1">{{ $destination->name }}</h2>
                            <div class="flex items-center text-gray-600 mb-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $destination->location }}
                            </div>
                            @if($destination->description)
                                <p class="text-gray-600 text-sm line-clamp-2">{{ Str::limit($destination->description, 150) }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                @if($ticket)
                    <!-- Ticket Information -->
                    <div class="grid md:grid-cols-2 gap-8">
                        <!-- Ticket Details -->
                        <div class="space-y-6">
                            <div class="bg-gradient-to-r from-purple-50 to-indigo-50 p-6 rounded-xl border border-purple-100">
                                <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                    </svg>
                                    Ticket Details
                                </h3>
                                
                                <div class="space-y-3">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Ticket Name:</span>
                                        <span class="font-semibold text-gray-900">{{ $ticket->ticket_name }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Price per ticket:</span>
                                        <span class="text-2xl font-bold text-purple-600">
                                            IDR {{ number_format($ticket->price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Features -->
                            @if($destination->tour_includes)
                                <div class="bg-green-50 p-6 rounded-xl border border-green-100">
                                    <h4 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        What's Included
                                    </h4>
                                    <p class="text-gray-600 text-sm leading-relaxed">{{ $destination->tour_includes }}</p>
                                </div>
                            @endif
                        </div>

                        <!-- Booking Form -->
                        <div class="space-y-6">
                            <div class="bg-white p-6 rounded-xl border-2 border-purple-100 shadow-lg">
                                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    Complete Your Booking
                                </h3>

                                <form action="{{ route('tickets.purchase', $ticket->id) }}" method="POST" class="space-y-6">
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
                                                   max="{{ min(10, $ticket->stock) }}"
                                                   {{ $ticket->stock <= 0 ? 'disabled' : '' }}
                                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 text-lg font-semibold {{ $ticket->stock <= 0 ? 'bg-gray-100' : '' }}"
                                                   onchange="updateTotal()">
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        @if($errors->has('quantity'))
                                            <p class="text-red-500 text-sm mt-1 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                {{ $errors->first('quantity') }}
                                            </p>
                                        @endif
                                    </div>

                                    <!-- Stock Information -->
                                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200 mb-4">
                                        <div class="flex items-center justify-between">
                                            <span class="text-blue-800 font-medium">Stock Available:</span>
                                            <div class="flex items-center">
                                                <span class="text-blue-900 font-bold text-lg mr-2">{{ number_format($ticket->stock) }}</span>
                                                <span class="px-2 py-1 text-xs rounded-full
                                                    {{ $ticket->stock <= 0 ? 'bg-red-100 text-red-800' : 
                                                       ($ticket->stock <= 10 ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                                    {{ $ticket->stock_status }}
                                                </span>
                                            </div>
                                        </div>
                                        @if($ticket->stock <= 10 && $ticket->stock > 0)
                                            <p class="text-yellow-700 text-sm mt-2">Limited stock available! Book now before it's sold out.</p>
                                        @elseif($ticket->stock <= 0)
                                            <p class="text-red-700 text-sm mt-2">Sorry, this ticket is currently out of stock.</p>
                                        @endif
                                    </div>

                                    <!-- Total Price Display -->
                                    <div class="bg-gray-50 p-4 rounded-lg border">
                                        <div class="flex justify-between items-center">
                                            <span class="text-gray-600 font-medium">Total Amount:</span>
                                            <span id="total-price" class="text-2xl font-bold text-purple-600">
                                                IDR {{ number_format($ticket->price, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" 
                                            {{ $ticket->stock <= 0 ? 'disabled' : '' }}
                                            class="w-full px-8 py-4 {{ $ticket->stock <= 0 ? 'bg-gray-400 cursor-not-allowed' : 'bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700' }} text-white font-bold rounded-xl shadow-lg transform transition duration-200 {{ $ticket->stock > 0 ? 'hover:scale-105' : '' }} focus:outline-none focus:ring-4 focus:ring-purple-300 flex items-center justify-center">
                                        @if($ticket->stock <= 0)
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                                            </svg>
                                            Out of Stock
                                        @else
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                            </svg>
                                            Book Now - {{ number_format($ticket->stock) }} Available
                                        @endif
                                    </button>
                                </form>
                            </div>

                            <!-- Security Notice -->
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
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
                        </div>
                    </div>
                @else 
                    <!-- No Ticket Available -->
                    <div class="text-center py-12">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No Tickets Available</h3>
                        <p class="text-gray-600 mb-6">No specific ticket details found for this booking. Please try another destination or contact support.</p>
                        <a href="{{ route('destinations.show', $destination->id) }}" 
                           class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Back to Destination
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function updateTotal() {
    const quantity = document.getElementById('quantity').value;
    const price = parseFloat('{{ $ticket ? $ticket->price : 0 }}');
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