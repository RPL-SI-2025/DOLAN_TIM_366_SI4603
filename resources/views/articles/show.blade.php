<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $article->title }}</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@1.6.5/dist/flowbite.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-900 font-sans leading-relaxed">

    <!-- Header -->
    <header class="border-b border-gray-200 mb-8">
        <div class="max-w-4xl mx-auto px-4 py-8 flex items-center justify-between">
            <div class="flex items-center">
                <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $article->title }}</h1>
            </div>
            <nav class="text-sm text-gray-500">
                <a href="{{ url('/') }}" class="hover:text-purple-600">Home</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 pb-16">
        <!-- Article Image -->
        <div class="mb-8">
            @if ($article->image)
                <img class="w-full rounded-lg shadow-md object-cover h-[400px] transition-transform duration-300 hover:scale-105" src="{{ asset('storage/' . $article->image) }}" alt="Image for {{ $article->title }}">
            @else
                <div class="w-full h-[400px] bg-gray-200 flex items-center justify-center rounded-lg text-gray-500">
                    <p>Gambar tidak tersedia</p>
                </div>
            @endif
        </div>

        <!-- Article Text -->
        <article class="prose prose-lg max-w-none prose-headings:font-bold prose-img:rounded-md prose-p:text-justify font-serif">
            {!! nl2br(e($article->text)) !!}
        </article>

         <!-- Back Button -->
         <div class="mt-12 text-center">
            <a href="{{ url('/articles') }}" class="inline-flex items-center gap-2 bg-purple-600 text-white px-5 py-3 rounded-full hover:bg-purple-700 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H3m0 0l6-6m-6 6l6 6"></path></svg>
                 Lihat lebih banyak artikel
            </a>
        </div>

        <!-- Flowbite Alert Component -->
        <div class="mt-8">
            <div class="alert alert-info">
                <span>Informasi: Anda dapat menemukan lebih banyak artikel di halaman utama.</span>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-300 py-6 mt-16">
        <div class="text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Dolan.
            <div class="mt-2">
            </div>
        </div>
    </footer>

</body>
</html>