<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $merchandise->name }} | Dolan</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />

    <!-- Flowbite CSS -->
    <link href="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-50 font-sans min-h-screen flex flex-col">

    <!-- Navbar -->
    <x-navbar />

    <!-- Main Content -->
    <main class="container mx-auto flex-grow px-4 py-8 max-w-5xl">
        <div class="bg-white rounded-3xl shadow-md p-6 md:p-10">
            <div class="grid md:grid-cols-2 gap-10 items-start">

                <div class="w-full rounded-xl overflow-hidden shadow-md">
                    <img src="{{ asset('storage/' . $merchandise->image) }}" 
                         alt="{{ $merchandise->name }}" 
                         class="w-full h-auto object-contain rounded-xl" />
                </div>

                <!-- Product Details -->
                <div class="flex flex-col justify-between space-y-6">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">
                            {{ $merchandise->name }}
                        </h1>
                        <p class="text-xl md:text-2xl font-bold text-purple-700 mb-4">
                            Rp {{ number_format($merchandise->price, 0, ',', '.') }}
                        </p>
                        <p class="text-sm text-gray-500 mb-4 flex items-center gap-2">
                            <!-- Lokasi icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.104 0 2-.895 2-2s-.896-2-2-2-2 .895-2 2 .896 2 2 2z" />
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s8-4.5 8-10a8 8 0 10-16 0c0 5.5 8 10 8 10z" />
                            </svg>
                            {{ $merchandise->location }}
                        </p>

                        <p class="text-gray-700 whitespace-pre-line leading-relaxed text-sm md:text-base mb-4">
                            {{ $merchandise->detail }}
                        </p>

                        <div>
                            <label class="block mb-2 font-medium text-gray-700">Ukuran Tersedia:</label>
                            <div class="flex flex-wrap gap-2">
                                @php
                                    $sizes = explode(',', $merchandise->size ?? '-');
                                @endphp
                                @foreach ($sizes as $size)
                                    @if(trim($size) !== '')
                                        <span class="bg-purple-100 text-purple-800 text-sm font-medium px-3 py-1 rounded-lg">
                                            {{ trim($size) }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <p class="text-sm text-gray-600 mt-4">
                            Stok tersedia: <span class="font-semibold">{{ $merchandise->stock }}</span>
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/checkout/{{ $merchandise->id }}" 
                           class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 text-white bg-purple-600 hover:bg-purple-700 rounded-xl font-semibold text-base transition-all">
                            🛒 Checkout Sekarang
                        </a>
                        <a href="/merchandise" 
                           class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-800 hover:bg-gray-200 rounded-xl font-medium text-base transition-all">
                            ← Kembali ke Daftar Merchandise
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Flowbite JS -->
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.bundle.js"></script>
</body>
</html>
