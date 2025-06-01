<x-layout-admin>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buat Artikel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">Buat Artikel Baru</h1>

        <form action="{{ route('dashboard.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block font-semibold">Judul</label>
                <input type="text" name="title" class="w-full border p-2 rounded" value="{{ old('title') }}">
                @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Isi Artikel</label>
                <textarea name="text" class="w-full border p-2 rounded" rows="5">{{ old('text') }}</textarea>
                @error('text') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Gambar</label>
                <input 
                type="file" 
                name="image"
                class=
                "block w-full border-2 border-blue-500 rounded-lg p-2 cursor-pointer 
                hover:border-blue-700 hover:bg-blue-50 transition">
                @error('image') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('dashboard.articles.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
        </form>
    </div>
</body>
</html>
</x-layout-admin>
