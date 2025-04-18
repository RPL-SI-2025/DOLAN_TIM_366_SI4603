<x-layout-admin>
    <style>
        .submit-button {
            display: block;
            width: 100%;
            max-width: 1500px;
            margin: 24px auto 0;
            padding: 12px 24px;
            background-color: rgb(61, 216, 118);
            color: white;
            font-weight: 600;
            border: 2px solid rgb(38, 255, 118);
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .submit-button:hover {
            background-color: #15803d;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>

    <div class="container mx-auto p-6 bg-white shadow-lg rounded-xl max-w-4xl">
        <h2 class="text-2xl font-semibold text-indigo-600 mb-8 text-center">Edit Destinasi Wisata</h2>

        <form action="{{ route('dashboard.destination.update', $destination->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="flex flex-col">
                <label for="name" class="text-sm font-semibold text-gray-700">Nama Destinasi</label>
                <input type="text" id="name" name="name" required value="{{ old('name', $destination->name) }}"
                    class="mt-2 p-4 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
            </div>

            <div class="flex flex-col">
                <label for="description" class="text-sm font-semibold text-gray-700">Deskripsi</label>
                <textarea id="description" name="description" rows="4" required
                    class="mt-2 p-4 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out">{{ old('description', $destination->description) }}</textarea>
            </div>

            <div class="flex flex-col">
                <label for="location" class="text-sm font-semibold text-gray-700">Lokasi</label>
                <input type="text" id="location" name="location" required value="{{ old('location', $destination->location) }}"
                    class="mt-2 p-4 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
            </div>

            <div class="flex flex-col">
                <label for="stock" class="text-sm font-semibold text-gray-700">Stock</label>
                <input type="number" id="stock" name="stock" required value="{{ old('stock', $destination->stock) }}"
                    class="mt-2 p-4 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
            </div>

            <div class="flex flex-col">
                <label for="price" class="text-sm font-semibold text-gray-700">Harga</label>
                <input type="number" id="price" name="price" required value="{{ old('price', $destination->price) }}"
                    class="mt-2 p-4 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
            </div>

            <div class="flex flex-col">
                <label for="image" class="text-sm font-semibold text-gray-700 mb-2">Gambar (Opsional)</label>
                <input type="file" id="image" name="image"
                    class="mt-2 p-4 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
                @if ($destination->image)
                    <img src="{{ asset('storage/' . $destination->image) }}" alt="Destinasi Image"
                        class="mt-4 rounded shadow max-w-xs">
                @endif
            </div>

            <button type="submit" class="submit-button">Perbarui Destinasi</button>
        </form>
    </div>
</x-layout-admin>
