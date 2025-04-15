<x-layout-admin>
    <div class="px-6 py-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Tambah Destinasi Wisata</h1>
        </div>

        <form action="{{ route('dashboard.destination.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-semibold">Nama Destinasi</label>
                    <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded" value="{{ old('name') }}" required>
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold">Deskripsi</label>
                    <textarea id="description" name="description" class="mt-1 p-2 w-full border rounded" rows="4" required>{{ old('description') }}</textarea>
                </div>

                <div>
                    <label for="location" class="block text-sm font-semibold">Lokasi</label>
                    <input type="text" id="location" name="location" class="mt-1 p-2 w-full border rounded" value="{{ old('location') }}" required>
                </div>

                <div>
                    <label for="stock" class="block text-sm font-semibold">Stock</label>
                    <input type="number" id="stock" name="stock" class="mt-1 p-2 w-full border rounded" value="{{ old('stock') }}" required>
                </div>

                <div>
                    <label for="price" class="block text-sm font-semibold">Harga</label>
                    <input type="number" id="price" name="price" class="mt-1 p-2 w-full border rounded" value="{{ old('price') }}" required>
                </div>

                <div>
                    <label for="image" class="block text-sm font-semibold">Gambar (Opsional)</label>
                    <input type="file" id="image" name="image" class="mt-1 p-2 w-full border rounded">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Destinasi</button>
                </div>
            </div>
        </form>
    </div>
</x-layout-admin>
