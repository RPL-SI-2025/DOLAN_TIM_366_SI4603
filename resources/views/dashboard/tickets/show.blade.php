<x-layout-admin>
    <x-slot name="title">Detail Tiket</x-slot>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-6">
            <a href="{{ route('dashboard.tickets.index') }}" 
               class="inline-flex items-center text-purple-600 hover:text-purple-800 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar Tiket
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">{{ $ticket->ticket_name }}</h1>
                        <p class="text-purple-100 text-lg">Detail Informasi Tiket</p>
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

            <div class="p-8">
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div class="bg-gradient-to-r from-purple-50 to-indigo-50 p-6 rounded-xl border border-purple-100">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                                Informasi Tiket
                            </h3>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">ID Tiket:</span>
                                    <span class="font-semibold text-gray-900">#{{ $ticket->id }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Nama Tiket:</span>
                                    <span class="font-semibold text-gray-900">{{ $ticket->ticket_name }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Harga:</span>
                                    <span class="text-2xl font-bold text-purple-600">
                                        IDR {{ number_format($ticket->price, 0, ',', '.') }}
                                    </span>
                                </div>
                                
                                @if($ticket->ticket_date)
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-600">Tanggal Berlaku:</span>
                                        <span class="font-semibold text-gray-900">{{ $ticket->ticket_date->format('D, d M Y') }}</span>
                                    </div>
                                @endif

                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Dibuat:</span>
                                    <span class="font-semibold text-gray-900">{{ $ticket->created_at->format('d M Y, H:i') }}</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Terakhir Update:</span>
                                    <span class="font-semibold text-gray-900">{{ $ticket->updated_at->format('d M Y, H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-6">
                        @if($ticket->destination)
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-6 rounded-xl border border-green-100">
                                <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Informasi Destinasi
                                </h3>
                                
                                @if($ticket->destination->image)
                                    <img src="{{ asset($ticket->destination->image) }}" 
                                         alt="{{ $ticket->destination->name }}" 
                                         class="w-full h-40 object-cover rounded-lg mb-4">
                                @endif
                                
                                <div class="space-y-3">
                                    <div>
                                        <span class="text-gray-600 block">Nama Destinasi:</span>
                                        <span class="font-semibold text-gray-900">{{ $ticket->destination->name }}</span>
                                    </div>
                                    
                                    <div>
                                        <span class="text-gray-600 block">Lokasi:</span>
                                        <span class="font-semibold text-gray-900">{{ $ticket->destination->location }}</span>
                                    </div>
                                    
                                    @if($ticket->destination->description)
                                        <div>
                                            <span class="text-gray-600 block">Deskripsi:</span>
                                            <p class="text-gray-900 text-sm leading-relaxed">{{ Str::limit($ticket->destination->description, 150) }}</p>
                                        </div>
                                    @endif

                                    <div class="pt-3">
                                        <a href="{{ route('dashboard.destination.show', $ticket->destination->id) }}" 
                                           class="inline-flex items-center text-green-600 hover:text-green-800 text-sm font-medium">
                                            Lihat Detail Destinasi
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="bg-red-50 p-6 rounded-xl border border-red-100">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-red-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-red-800 font-medium">Destinasi tidak ditemukan</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mt-8 flex space-x-4">
                    <a href="{{ route('dashboard.tickets.edit', $ticket->id) }}" 
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-yellow-500 to-orange-500 hover:from-yellow-600 hover:to-orange-600 text-white font-bold rounded-xl shadow-lg transform transition duration-200 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-yellow-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Tiket
                    </a>
                    
                    <form action="{{ route('dashboard.tickets.destroy', $ticket->id) }}" method="POST" 
                          onsubmit="return confirm('Yakin ingin menghapus tiket ini?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold rounded-xl shadow-lg transform transition duration-200 hover:scale-105 focus:outline-none focus:ring-4 focus:ring-red-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus Tiket
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout-admin>