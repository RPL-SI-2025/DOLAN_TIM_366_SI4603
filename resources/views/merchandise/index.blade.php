<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchandise | Dolan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <x-navbar></x-navbar>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-12">
        <h1 class="text-4xl font-extrabold text-center text-gray-800 mb-10">Daftar Merchandise</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            @foreach ($merchandises as $merchandise)
            <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 ease-in-out overflow-hidden">
                <img src="{{ asset($merchandise->image) }}" alt="{{ $merchandise->name }}" class="w-full h-52 object-cover">
                <div class="p-5">
                    <h2 class="text-xl font-bold text-gray-900 mb-1">{{ $merchandise->name }}</h2>
                    <p class="text-lg text-purple-600 font-semibold mb-1">Rp {{ number_format($merchandise->price, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500 mb-4">📍 {{ $merchandise->location }}</p>
                    <a href="{{ route('merchandise.show', $merchandise->id) }}"
                       class="inline-block text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded-lg transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</body>
</html>
