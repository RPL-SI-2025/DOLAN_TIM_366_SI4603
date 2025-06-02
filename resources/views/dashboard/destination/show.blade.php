<x-layout-admin>
        <x-slot name="title">Detail Destinasi - {{ $destination->name }}</x-slot>
        
        <div class="container mx-auto px-6 py-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Detail Destinasi</h1>
                <div class="flex space-x-3">
                    <a href="{{ route('dashboard.destination.index') }}" 
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali
                    </a>
                    <a href="{{ route('dashboard.destination.edit', $destination->id) }}" 
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </a>
                </div>
            </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <!-- Header with main image -->
            <div class="relative h-64 md:h-80 bg-gray-200">
                @if($destination->image)
                    <img src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->name }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-500">
                        <span>Tidak ada gambar utama</span>
                    </div>
                @endif
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                    <h2 class="text-3xl font-bold text-white">{{ $destination->name }}</h2>
                    <p class="text-white/90 flex items-center mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        {{ $destination->location }}
                    </p>
                </div>
            </div>

            <!-- Main content -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Left column - Basic info -->
                    <div class="md:col-span-2 space-y-6">
                        <!-- Description -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Deskripsi</h3>
                            <div class="bg-gray-50 p-4 rounded border border-gray-100">
                                <p class="text-gray-700 whitespace-pre-line">{{ $destination->description }}</p>
                            </div>
                        </div>

                        <!-- Tour Includes -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Fasilitas & Fitur Tour</h3>
                            <div class="bg-gray-50 p-4 rounded border border-gray-100">
                                @if($destination->tour_includes)
                                    <p class="text-gray-700 whitespace-pre-line">{{ $destination->tour_includes }}</p>
                                @else
                                    <p class="text-gray-500 italic">Tidak ada informasi fasilitas</p>
                                @endif
                            </div>
                        </div>

                        <!-- Payment Info -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Informasi Pembayaran</h3>
                            <div class="bg-gray-50 p-4 rounded border border-gray-100">
                                @if($destination->tour_payments)
                                    <p class="text-gray-700 whitespace-pre-line">{{ $destination->tour_payments }}</p>
                                @else
                                    <p class="text-gray-500 italic">Tidak ada informasi pembayaran</p>
                                @endif
                            </div>
                        </div>

                        <!-- Additional Images -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Galeri Foto</h3>
                            @if($destination->additional_images && is_array($destination->additional_images) && count($destination->additional_images) > 0)
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                    @foreach($destination->additional_images as $image)
                                        <a href="{{ asset('storage/' . $image) }}" target="_blank" class="block h-32 bg-gray-100 rounded overflow-hidden">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Galeri {{ $destination->name }}" class="w-full h-full object-cover hover:opacity-90 transition">
                                        </a>
                                    @endforeach
                                </div>
                            @else
                                <div class="bg-gray-50 p-4 rounded border border-gray-100">
                                    <p class="text-gray-500 italic">Tidak ada foto tambahan</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Right column - Stats & info -->
                    <div class="space-y-6">
                        <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
                            <div class="p-5">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Tiket</h3>
                                
                                <div class="space-y-4">
                                    <!-- Ticket Status -->
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Status Tiket:</span>
                                        <span class="font-medium {{ $destination->has_ticket ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $destination->has_ticket ? 'Memerlukan Tiket' : 'Tidak Perlu Tiket' }}
                                        </span>
                                    </div>
                                    
                                    <!-- Price -->
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Harga:</span>
                                        <span class="font-medium text-gray-900">
                                            @if($destination->has_ticket && $destination->ticket)
                                                Rp{{ number_format($destination->ticket->price, 0, ',', '.') }}
                                            @else
                                                <span class="text-gray-500">-</span>
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <!-- Stock -->
                                    <div class="flex justify-between">
                                        <span class="text-gray-600">Stok Tersedia:</span>
                                        <span class="font-medium text-gray-900">
                                            @if($destination->has_ticket && $destination->ticket)
                                                {{ number_format($destination->ticket->stock, 0, ',', '.') }} tiket
                                            @else
                                                <span class="text-gray-500">-</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="border-t border-gray-200 bg-gray-50 px-5 py-3">
                                <div class="text-sm text-gray-500">
                                    Terakhir diperbarui: {{ $destination->updated_at->format('d M Y, H:i') }}
                                </div>
                            </div>
                        </div>
                        
                        <!-- Ratings Summary (if implemented) -->
                        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-5">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Rating & Ulasan</h3>
                            <div class="flex items-center mb-2">
                                <div class="flex text-yellow-400">
                                    @php
                                        $avgRating = $destination->averageRating() ?? 0;
                                        $fullStars = floor($avgRating);
                                        $halfStar = $avgRating - $fullStars > 0.2 ? 1 : 0;
                                        $emptyStars = 5 - $fullStars - $halfStar;
                                    @endphp

                                    @for($i = 0; $i < $fullStars; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor

                                    @if($halfStar)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endif

                                    @for($i = 0; $i < $emptyStars; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                        </svg>
                                    @endfor
                                </div>
                                <span class="ml-2 text-gray-700 font-medium">{{ number_format($avgRating, 1) }}</span>
                                <span class="ml-1 text-gray-500">({{ $destination->ratings->count() }} ulasan)</span>
                            </div>
                            <a href="{{ route('dashboard.destination.ratings', $destination->id) }}" class="inline-block mt-2 text-blue-600 hover:text-blue-800 font-medium">
                                Lihat semua ulasan →
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout-admin>