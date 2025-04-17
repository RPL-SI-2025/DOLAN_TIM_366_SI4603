<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Artikel Wisata</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-purple-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Header -->
<header class="bg-purple-200 text-purple-900 py-10 text-center shadow-md">
    <h1 class="text-4xl font-bold mb-2">Artikel Wisata</h1>
    <p class="text-lg text-purple-700">Temukan cerita dan inspirasi destinasi wisata Nusantara</p>
</header>

    <!-- Main Content -->
    <main class="flex-grow container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($artikels as $artikel)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-105 hover:shadow-xl">
                    <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $artikel->image) }}" alt="Gambar {{ $artikel->text }}">
                    <div class="p-5">
                        <h3 class="text-lg font-semibold text-purple-700 mb-2">
                            {{ Str::limit($artikel->text, 60) }}
                        </h3>
                        <p class="text-sm text-gray-600 mb-4">
                            {{ Str::limit($artikel->text, 100) }}...
                        </p>
                        <a href="#" class="inline-block text-purple-600 hover:text-purple-800 font-medium text-sm">Baca Selengkapnya →</a>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-purple-100 text-center py-6 text-sm text-purple-600">
        &copy; {{ date('Y') }} Dolan. Semua Hak Dilindungi.
    </footer>

</body>
</html>
