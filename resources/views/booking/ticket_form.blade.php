@extends('layouts.app') {{-- Assuming you have a main layout file --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-6">
            <h1 class="text-3xl font-bold text-white text-center">Book Your Ticket</h1>
        </div>

        <div class="p-6">
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="mb-6 pb-4 border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-800">{{ $destination->name }}</h2>
                <p class="text-gray-600">Location: {{ $destination->location }}</p>
            </div>

            @if($ticket)
                <div>
                    <h3 class="text-xl font-medium text-indigo-700 mb-1">{{ $ticket->ticket_name }}</h3>
                    <p class="text-2xl font-bold text-gray-900 mb-2">Price: IDR {{ number_format($ticket->price, 0, ',', '.') }} / ticket</p>
                    @if($ticket->ticket_date)
                        <p class="text-sm text-gray-500 mb-4">Valid for date: {{ $ticket->ticket_date->format('D, d M Y') }}</p>
                    @endif

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
                                class="w-full bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-600 hover:to-teal-600 text-white font-semibold py-3 px-6 rounded-md shadow-md transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                            Proceed to Payment
                        </button>
                    </form>
                </div>
            @else 
                <p class="text-center text-gray-600 py-4">No specific ticket details found for this booking. Please try another destination or contact support.</p>
            @endif

            <div class="mt-8 text-center">
                <a href="{{ route('destinations.show', $destination->id) }}" class="text-indigo-600 hover:text-indigo-800 hover:underline">&laquo; Back to Destination Details</a>
            </div>
        </div>
    </div>
</div>
@endsection 