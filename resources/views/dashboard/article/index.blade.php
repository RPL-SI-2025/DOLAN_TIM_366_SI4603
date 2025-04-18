<x-layout-admin>
<x-slot name="title">Daftar Artikel</x-slot>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Artikel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-5xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Daftar Artikel</h1>

        @if(session('success'))
            <div class="mb-4 text-green-600 font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('dashboard.articles.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
            Tambah Artikel
        </a>

        <table class="w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">Judul</th>
                    <th class="border border-gray-300 px-4 py-2">Gambar</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr class="border-t">
                        <td class="border border-gray-300 px-4 py-2">{{ $article->title }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" alt="Image" class="w-16 h-16 object-cover">
                            @else
                                <span class="text-gray-500 italic">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2 space-x-2">
                            <a href="{{ route('dashboard.articles.edit', $article->id) }}" class="text-blue-500 hover:underline">Edit</a>

                            <form action="{{ route('dashboard.articles.destroy', $article->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
            {{ $articles->links() }}
        </div>
    </div>
</body>
</html>

</x-layout-admin>
