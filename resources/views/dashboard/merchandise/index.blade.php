<x-layout-admin>
    <div class="max-w-7xl mx-auto bg-white p-6 rounded shadow mt-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Merchandise</h1>
            <a href="{{ route('dashboard.merchandise.create') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Tambah Merchandise</a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse ($merchandises as $item)
                <div class="bg-gray-50 rounded-lg shadow p-4 flex flex-col items-center">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="Gambar" class="w-48 h-48 object-cover rounded mb-4 border">
                    @else
                        <div class="w-48 h-48 flex items-center justify-center bg-gray-200 rounded mb-4 text-gray-400">Tidak ada gambar</div>
                    @endif
                    <div class="w-full">
                        <h2 class="font-bold text-lg mb-1">{{ $item->name }}</h2>
                        <div class="text-green-700 font-semibold mb-1">Rp{{ number_format($item->price, 0, ',', '.') }}</div>
                        <div class="text-sm text-gray-600 mb-1">Stok: {{ $item->stock }}</div>
                        <div class="text-sm text-gray-600 mb-1">Ukuran: {{ $item->size ?? '-' }}</div>
                        <div class="text-sm text-gray-600 mb-1">Lokasi: {{ $item->location }}</div>
                        <div class="text-sm text-gray-600 mb-2">Deskripsi: {{ $item->detail ?? '-' }}</div>
                        <div class="flex gap-2">
                            <a href="{{ route('dashboard.merchandise.edit', $item->id) }}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">Edit</a>
                            <form action="{{ route('dashboard.merchandise.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus merchandise ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500 py-8">Belum ada merchandise.</div>
            @endforelse
        </div>
    </div>
</x-layout-admin>