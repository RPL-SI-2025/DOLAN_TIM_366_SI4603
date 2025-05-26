<x-layout-admin>
    <x-slot name="title">Daftar Merchandise</x-slot>
    
    <div class="px-6 py-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Daftar Merchandise</h1>
            <a href="{{ route('dashboard.destination.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Merchandise
            </a>
        </div>

        <div class="overflow-hidden bg-white shadow-md rounded-lg">
            <div class="overflow-x-auto">
                    
                    <table class="w-full table-auto border-collapse border border-gray-300">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border border-gray-300 px-4 py-2">#</th>
                                <th class="border border-gray-300 px-4 py-2">Nama</th>
                                <th class="border border-gray-300 px-4 py-2">Lokasi</th>
                                <th class="border border-gray-300 px-4 py-2">Stok</th>
                                <th class="border border-gray-300 px-4 py-2">Harga</th>
                                <th class="border border-gray-300 px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($merchandises as $merchandise)
                                <tr class="border-t">
                                    <td class="border border-gray-300 px-4 py-2">{{ $merchandise->id }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $merchandise->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $merchandise->location }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $merchandise->stock }}</td>
                                    <td class="border border-gray-300 px-4 py-2">Rp{{ number_format($merchandise->price, 0, ',', '.') }}</td>
                                    <td class="border border-gray-300 px-4 py-2 space-x-2">
                                        <a href="" class="text-blue-500 hover:underline">Edit</a>
                                        <form action="{" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4">
                    </div>
                </div>
            </main>
        </div>
    </body>
    </html>
</x-layout-admin>
