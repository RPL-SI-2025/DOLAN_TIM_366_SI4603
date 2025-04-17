<x-layout-admin>
    <div class="px-6 py-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Tambah Destinasi Wisata</h1>
        </div>

        <form action="{{ route('dashboard.destination.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
            @csrf

            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700">Nama Destinasi</label>
                    <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded focus:ring focus:ring-blue-300" value="{{ old('name') }}" required>
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700">Deskripsi</label>
                    <textarea id="description" name="description" class="mt-1 p-2 w-full border rounded focus:ring focus:ring-blue-300" rows="4" required>{{ old('description') }}</textarea>
                </div>

                <div>
                    <label for="location" class="block text-sm font-semibold text-gray-700">Lokasi</label>
                    <input type="text" id="location" name="location" class="mt-1 p-2 w-full border rounded focus:ring focus:ring-blue-300" value="{{ old('location') }}" required>
                </div>

                <div>
                    <label for="stock" class="block text-sm font-semibold text-gray-700">Stock</label>
                    <input type="number" id="stock" name="stock" class="mt-1 p-2 w-full border rounded focus:ring focus:ring-blue-300" value="{{ old('stock') }}" required>
                </div>

                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700">Harga</label>
                    <input type="number" id="price" name="price" class="mt-1 p-2 w-full border rounded focus:ring focus:ring-blue-300" value="{{ old('price') }}" required>
                </div>

                <div>
                    <label for="image" class="block text-sm font-semibold text-gray-700">Gambar (Opsional)</label>
                    <input type="file" id="image" name="image" class="mt-1 p-2 w-full border rounded focus:ring focus:ring-blue-300">
                </div>

                <div class="flex justify-end gap-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">Tambah Destinasi</button>
                </div>
            </div>
        </form>
    </div>
</x-layout-admin>
