<x-layout-admin>
    <div class="px-6 py-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Destinasi Wisata</h1>
            <a href="{{ route('admin.destinations.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Tambah Destinasi
            </a>
        </div>

        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-100 border-b">
                    <tr>
                        <th class="px-4 py-3 font-semibold">#</th>
                        <th class="px-4 py-3 font-semibold">Nama</th>
                        <th class="px-4 py-3 font-semibold">Lokasi</th>
                        <th class="px-4 py-3 font-semibold">Stock</th>
                        <th class="px-4 py-3 font-semibold">Harga</th>
                        <th class="px-4 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($destinations as $destination)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $destination->name }}</td>
                            <td class="px-4 py-2">{{ $destination->location }}</td>
                            <td class="px-4 py-2">{{ $destination->stock }}</td>
                            <td class="px-4 py-2">Rp{{ number_format($destination->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('admin.destinations.edit', $destination) }}"
                                   class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.destinations.destroy', $destination) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus destinasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada destinasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout-admin>
