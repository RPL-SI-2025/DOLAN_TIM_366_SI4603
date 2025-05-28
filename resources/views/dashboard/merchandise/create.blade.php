<x-layout-admin>
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow mt-8">
        <h1 class="text-xl font-bold mb-4">Tambah Merchandise</h1>
        <form action="{{ route('dashboard.merchandise.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block font-semibold">Nama Merchandise</label>
                <input type="text" name="name" class="w-full border p-2 rounded" value="{{ old('name') }}">
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-semibold">Stok</label>
                <input type="number" name="stock" class="w-full border p-2 rounded" value="{{ old('stock') }}">
                @error('stock') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-semibold">Harga</label>
                <input type="number" name="price" class="w-full border p-2 rounded" value="{{ old('price') }}">
                @error('price') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-semibold">Lokasi</label>
                <input type="text" name="location" class="w-full border p-2 rounded" value="{{ old('location') }}">
                @error('location') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-semibold">Deskripsi</label>
                <textarea name="detail" class="w-full border p-2 rounded" rows="4">{{ old('detail') }}</textarea>
                @error('detail') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-semibold">Ukuran (opsional, pisahkan dengan koma)</label>
                <input type="text" name="size" class="w-full border p-2 rounded" value="{{ old('size') }}">
                @error('size') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-semibold">Gambar</label>
                <input type="file" name="image" class="block w-full border rounded p-2">
                @error('image') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('dashboard.merchandise.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
        </form>
    </div>
</x-layout-admin>