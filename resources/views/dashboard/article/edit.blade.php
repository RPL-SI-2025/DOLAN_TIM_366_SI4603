<x-layout-admin>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Artikel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-xl font-bold mb-4">Edit Artikel</h1>

        <form action="{{ route('dashboard.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @method('PUT')

            <div>
                <label class="block font-semibold">Judul</label>
                <input type="text" name="title" class="w-full border p-2 rounded" value="{{ old('title', $article->title) }}">
                @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Isi Artikel</label>
                <textarea name="text" class="w-full border p-2 rounded" rows="5">{{ old('text', $article->text) }}</textarea>
                @error('text') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block font-semibold">Gambar</label>
                @if ($article->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $article->image) }}" class="w-32 h-32 object-cover">
                    </div>
                @endif
                <input type="file" name="image" class="block w-full">
                @error('image') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('dashboard.articles.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
        </form>
    </div>
</body>
</html>
</x-layout-admin>

