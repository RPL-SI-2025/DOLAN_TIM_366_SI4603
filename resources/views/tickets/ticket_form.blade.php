<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Booking Ticket | {{ $destination->name }}</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
  </style>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-b from-[#F0ECEC] to-white">
<x-navbar />
  <div class="container mx-auto px-4 py-8">
     <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
         <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-6">
             <h1 class="text-3xl font-extrabold text-white text-center">Book Your Ticket</h1>
         </div>

         <div class="p-6">
             @if(session('error'))
                 <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                     <strong class="font-bold">Error!</strong>
                     <span class="block sm:inline">{{ session('error') }}</span>
                 </div>
             @endif

             <div class="mb-6 pb-4 border-b border-gray-200">
                 <h2 class="text-2xl font-bold text-purple-800">{{ $destination->name }}</h2>
                 <p class="text-gray-600">Location: {{ $destination->location }}</p>
             </div>

             @if($ticket)
                 <div>
                     <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $ticket->ticket_name }}</h3>
                     <p class="text-2xl font-bold text-gray-900 mb-2">Price: IDR {{ number_format($ticket->price, 0, ',', '.') }} / ticket</p>
                     @if($ticket->ticket_date)
                         <p class="text-sm text-gray-500 mb-4">Valid for date: {{ $ticket->ticket_date->format('D, d M Y') }}</p>
                     @endif
                     {{-- You can add more ticket-specific details here if needed --}}

                     <form action="{{ route('purchase.ticket', $ticket->id) }}" method="POST" class="mt-6">
                         @csrf
                         <div class="mb-4">
                             <label for="quantity" class="block text-lg font-medium text-gray-700 mb-2">Select Quantity:</label>
                             <input type="number" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" min="1" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm 
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                             @if($errors->has('quantity'))
                                 <p class="text-red-500 text-xs mt-1">{{ $errors->first('quantity') }}</p>
                             @endif
                         </div>

                         <button type="submit" 
                                 class="w-full bg-gradient-to-r from-purple-500 to-black hover:from-purple-600 hover:to-black text-white font-bold py-3 px-6 rounded-md shadow-md transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
                             Proceed to Payment
                         </button>
                     </form>
                 </div>
             @else 
                 {{-- This case should ideally be handled by the controller redirecting back --}}
                 <p class="text-center text-gray-600 py-4">No specific ticket details found for this booking. Please try another destination or contact support.</p>
             @endif

             <div class="mt-8 text-center">
                 <a href="{{ route('destinations.show', $destination->id) }}" class="text-purple-600 hover:text-purple-800 hover:underline">&laquo; Back to Destination Details</a>
             </div>
         </div>
     </div>
 </div>
</body>