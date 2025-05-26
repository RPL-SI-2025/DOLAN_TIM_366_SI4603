<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $merchandise->name }} | Dolan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans min-h-screen flex flex-col">

    <!-- Navbar -->
    <x-navbar />

    <!-- Merchandise Detail (Full Screen) -->
    <main class="flex-grow">
        <div class="min-h-screen flex items-center justify-center px-4 py-10">
            <div class="w-full max-w-6xl bg-white shadow-2xl rounded-3xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
                
                <!-- Gambar -->
                <div class="h-72 md:h-auto">
                    <img src="{{ asset($merchandise->image) }}" alt="{{ $merchandise->name }}" class="w-full h-full object-cover">
                </div>

                <!-- Info Detail -->
                <div class="p-8 flex flex-col justify-between">
                    <div class="overflow-y-auto max-h-[70vh] pr-2">
                        <h1 class="text-4xl font-extrabold text-gray-800 mb-3">{{ $merchandise->name }}</h1>
                        <p class="text-3xl text-purple-600 font-bold mb-2">Rp {{ number_format($merchandise->price, 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-500 mb-4">📍 {{ $merchandise->location }}</p>

                        <div class="text-gray-700 text-base leading-relaxed mb-6 whitespace-pre-line">
                            {{ $merchandise->detail }}
                        </div>

                        <p class="text-sm text-gray-600 mb-8">Stok tersedia: <span class="font-semibold">{{ $merchandise->stock }}</span></p>
                    </div>

                    <!-- Tombol -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="/checkout/{{ $merchandise->id }}"
                           class="bg-green-600 text-white px-6 py-3 rounded-xl hover:bg-green-700 transition text-sm font-semibold text-center w-full sm:w-auto">
                            🛒 Checkout Sekarang
                        </a>
                        <a href="/merchandise"
                           class="bg-gray-200 text-gray-700 px-6 py-3 rounded-xl hover:bg-gray-300 transition text-sm font-medium text-center w-full sm:w-auto">
                            ← Kembali ke Daftar Merchandise
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
