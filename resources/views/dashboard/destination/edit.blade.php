<x-layout-admin>
<x-slot name="title">Daftar Destinasi</x-slot>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Destinasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
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
                <input type="text" id="location" name="location" required value="{{ old('location', $destination->location) }} "
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
                    <img src="{{ asset("storage/{$destination->image}") }}" alt="Destinasi Image"
                        class="mt-4 rounded shadow max-w-xs">
                @endif
            </div>

            <div class="flex flex-col">
            <label class="text-sm font-semibold text-gray-700 mb-2">Additional Images (opsional)</label>

            @if ($destination->additional_images && is_array($destination->additional_images))
                <div class="mt-4 flex flex-wrap gap-4">
                    @foreach ($destination->additional_images as $index => $image)
                        <div class="relative w-36" id="existing-image-{{ $index }}">
                            {{-- Gambar lama --}}
                            <img src="{{ asset("storage/{$image}") }}" alt="Additional Image"
                                class="rounded shadow w-full h-24 object-cover mb-2">

                            {{-- Input untuk mengganti gambar lama --}}
                            <input type="file" name="replaced_images[{{ $image }}]"
                                class="text-xs text-gray-600 block w-full bg-gray-50 border border-gray-300 rounded p-1 mb-2">

                            {{-- Tombol hapus --}}
                            <button type="button" onclick="removeExistingImage('{{ $index }}')" 
                                class="absolute top-0 right-0 -mt-2 -mr-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                            
                            {{-- Hidden input hanya jika user hapus --}}
                            <input type="hidden" id="removed-image-{{ $index }}" value="{{ $image }}">
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Input untuk menambah gambar baru (bukan pengganti) --}}
            <div class="mt-6">
                <label for="additional_images" class="text-sm font-semibold text-gray-700">Tambah Gambar Baru</label>
                <input type="file" id="additional_images" name="additional_images[]" multiple
                    class="mt-2 p-4 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
            </div>

        </div>
            <button type="submit" class="w-full max-w-6xl mx-auto mt-6 px-6 py-3 bg-green-500 text-white font-semibold border-2 border-green-400 rounded-lg hover:bg-green-700 hover:shadow-lg transition duration-300 ease-in-out">
                Perbarui Destinasi
            </button>
        </form>
    </div>
</body>
</html>

    <script>
        function removeExistingImage(index) {
            const imageName = document.getElementById('removed-image-' + index).value;

            // Tambah input hidden ke form
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'removed_images[]';
            hiddenInput.value = imageName;
            document.querySelector('form').appendChild(hiddenInput);

            // Hapus dari UI
            document.getElementById('existing-image-' + index).remove();
        }
    </script>
</x-layout-admin>
