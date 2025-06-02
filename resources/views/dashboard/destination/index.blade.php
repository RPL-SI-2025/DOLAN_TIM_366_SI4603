<x-layout-admin>
    <x-slot name="title">Daftar Destinasi</x-slot>


    <div class="px-6 py-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Destinasi Wisata</h1>
            <div class="flex gap-3">
                <a href="{{ route('dashboard.tickets.index') }}" 
                   class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition flex items-center gap-2 shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Kelola Tiket
                </a>
                <a href="{{ route('dashboard.destination.create') }}" 
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition flex items-center gap-2 shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Destinasi
                </a>
            </div>
        </div>

        <div class="overflow-hidden bg-white shadow-md rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tiket</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar Utama</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar Tambahan</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($destinations as $destination)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-900">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">{{ $destination->name }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">{{ $destination->location }}</td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">
                                    <div class="flex flex-col space-y-1">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $destination->has_ticket ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $destination->has_ticket ? 'Ya' : 'Tidak' }}
                                        </span>
                                        @if($destination->has_ticket)
                                            @if($destination->hasTicket())
                                                <div class="text-xs text-blue-600">
                                                    <div>✓ Tiket tersedia</div>
                                                    <div>Stok: {{ $destination->ticket->stock }}</div>
                                                    <div>Harga: Rp{{ number_format($destination->ticket->price, 0, ',', '.') }}</div>
                                                </div>
                                            @else
                                                <a href="{{ route('dashboard.tickets.create', ['destination_id' => $destination->id]) }}" 
                                                   class="text-xs text-orange-600 hover:text-orange-800">
                                                    → Buat tiket
                                                </a>
                                            @endif
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    @if ($destination->image)
                                        <img src="{{ asset('storage/' . $destination->image) }}" 
                                             alt="{{ $destination->name }}" 
                                             class="w-24 h-24 object-cover rounded shadow-sm">
                                    @else
                                        <span class="text-sm text-gray-500 italic">Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if ($destination->additional_images && is_array($destination->additional_images) && count($destination->additional_images) > 0)
                                        <div class="flex space-x-2">
                                            @foreach (array_slice($destination->additional_images, 0, 3) as $index => $image)
                                                <img src="{{ asset('storage/' . $image) }}" 
                                                     alt="Additional Image {{ $index + 1 }}" 
                                                     class="w-16 h-16 object-cover rounded shadow-sm">
                                            @endforeach
                                            @if (count($destination->additional_images) > 3)
                                                <div class="w-16 h-16 bg-gray-200 flex items-center justify-center rounded text-gray-700 font-medium">
                                                    +{{ count($destination->additional_images) - 3 }}
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-500 italic">Tidak ada gambar tambahan</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-600">
                                    <span class="px-2 py-1 text-xs rounded-full 
                                        {{ $destination->status == 'approved' ? 'bg-green-100 text-green-800' : ($destination->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($destination->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('dashboard.destination.show', $destination->id) }}" 
                                           class="text-indigo-600 hover:text-indigo-900 transition flex items-center gap-1 mr-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Detail
                                        </a>
                                        <a href="{{ route('dashboard.destination.edit', $destination->id) }}" 
                                           class="text-blue-600 hover:text-blue-900 transition flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('dashboard.destination.destroy', $destination->id) }}" 
                                              method="POST" 
                                              class="inline-block" 
                                              onsubmit="return confirm('Yakin hapus destinasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 transition flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                        <a href="{{ route('dashboard.destination.ratings', $destination->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 transition">Lihat Rating</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-4 py-4 text-center text-gray-500 italic">Belum ada destinasi wisata.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout-admin>