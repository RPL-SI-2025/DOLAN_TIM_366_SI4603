<x-layout-admin>
    <x-slot name="title">Detail Rating</x-slot>
    
    <div class="px-6 py-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Detail Rating</h1>
            <a href="{{ route('dashboard.ratings.index') }}" 
               class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali ke Daftar
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi User</h2>
                <div class="space-y-3">
                    <div>
                        <span class="text-gray-600 font-medium">Nama:</span>
                        <span class="text-gray-900 ml-2">{{ $rating->user->name }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600 font-medium">Email:</span>
                        <span class="text-gray-900 ml-2">{{ $rating->user->email }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informasi Destinasi</h2>
                <div class="space-y-3">
                    <div>
                        <span class="text-gray-600 font-medium">Nama:</span>
                        <span class="text-gray-900 ml-2">{{ $rating->destination->name }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600 font-medium">Lokasi:</span>
                        <span class="text-gray-900 ml-2">{{ $rating->destination->location }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Rating & Feedback</h2>
            <div class="space-y-4">
                <div>
                    <span class="text-gray-600 font-medium">Rating:</span>
                    <span class="text-gray-900 ml-2 font-semibold">{{ $rating->rating }}/5</span>
                </div>
                <div>
                    <span class="text-gray-600 font-medium">Feedback:</span>
                    <div class="mt-2 bg-gray-50 p-4 rounded border border-gray-200 text-gray-800">
                        {{ $rating->feedback }}
                    </div>
                </div>
                <div class="flex gap-6">
                    <div>
                        <span class="text-gray-600 font-medium">Disubmit:</span>
                        <span class="text-gray-900 ml-2">{{ $rating->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="text-gray-600 font-medium">Terakhir Diupdate:</span>
                        <span class="text-gray-900 ml-2">{{ $rating->updated_at->format('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex">
            <form action="{{ route('dashboard.ratings.destroy', $rating) }}" 
                  method="POST" 
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus rating ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Hapus Rating
                </button>
            </form>
        </div>
    </div>
</x-layout-admin>