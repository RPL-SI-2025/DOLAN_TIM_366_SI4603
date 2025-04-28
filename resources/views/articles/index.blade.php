<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Artikel Wisata</title>
    @vite('resources/css/app.css')
    <!-- Flowbite CSS -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.5/dist/flowbite.min.js"></script>
</head>
<x-navbar></x-navbar>
<body class="bg-purple-50 text-gray-800 flex flex-col min-h-screen">



    <!-- Jumbotron Section from Flowbite -->
    <section class="text-purple py-12 px-6 md:px-12 text-center">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold mb-4">Temukan Artikel Wisata yang Menginspirasi</h2>
            <p class="text-xl mb-6">Baca artikel-artikel menarik yang memberikan informasi tentang destinasi wisata terbaik di Indonesia. Temukan destinasi favorit Anda berikutnya!</p>
        </div>
    </section>

    <!-- Main Section -->
    <main class="flex-grow container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach ($articles as $article)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform hover:scale-105 hover:shadow-xl">
                    <!-- Artikel Image -->
                    <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $article->image) }}" alt="Gambar {{ $article->title }}">
                    
                    <div class="p-5">
                        <!-- Artikel Title -->
                        <h3 class="text-lg font-semibold text-purple-700 mb-2">
                            {{ Str::limit($article->title, 60) }}
                        </h3>

                        <!-- Artikel Text -->
                        <p class="text-sm text-gray-600 mb-4">
                            {{ Str::limit($article->text, 100) }}...
                        </p>

                        <!-- Link to Show Article Page -->
                        <a href="{{ route('articles.show', $article->id) }}" class="inline-block text-purple-600 hover:text-purple-800 font-medium text-sm">
                            Lihat Detail Artikel
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    </main>

    <!-- Footer Section -->
    <footer class="bg-purple-100 text-center py-6 text-sm text-purple-600 mt-12">
        <p>&copy; {{ date('Y') }} Dolan. Website ini dikelola oleh tim Dolan Wisata.</p>
    </footer>

</body>
</html>
