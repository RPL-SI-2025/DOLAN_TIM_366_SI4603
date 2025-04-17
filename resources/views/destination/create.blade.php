<x-layout-admin>
    <div class="px-6 py-4">
        <h1 class="text-2xl font-bold mb-6">Tambah Destinasi Baru</h1>

        <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Destinasi</label>
                <input type="text" name="name" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" rows="4" required></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" name="location" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Stock Tiket</label>
                <input type="number" name="stock" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Harga Tiket</label>
                <input type="number" name="price" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Gambar</label>
                <input type="file" name="image" class="mt-1 block w-full text-sm text-gray-500 file:border file:rounded file:px-4 file:py-2 file:bg-gray-100">
            </div>

            <div class="pt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Simpan
                </button>
                <a href="{{ route('admin.destinations.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</x-layout-admin>
