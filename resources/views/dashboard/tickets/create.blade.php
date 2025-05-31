<x-layout-admin>
    <x-slot name="title">Tambah Tiket Baru</x-slot>

    <div class="container mx-auto p-6 bg-white shadow-lg rounded-xl max-w-2xl">
        <h2 class="text-2xl font-semibold text-indigo-600 mb-8 text-center">Tambah Tiket Baru</h2>

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Terjadi kesalahan:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('dashboard.tickets.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="ticket_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Tiket</label>
                <input type="text" name="ticket_name" id="ticket_name" value="{{ old('ticket_name') }}" required
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
            </div>

            <div>
                <label for="destination_id" class="block text-sm font-medium text-gray-700 mb-1">Destinasi</label>
                @if(isset($selectedDestinationId) && $selectedDestinationId)
                    @php
                        $selectedDestination = $destinations->where('id', $selectedDestinationId)->first();
                    @endphp
                    @if($selectedDestination)
                        <!-- Tampilkan destinasi yang sudah dipilih sebagai readonly -->
                        <div class="w-full p-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-700">
                            <div class="flex items-center justify-between">
                                <span class="font-medium">{{ $selectedDestination->name }} - {{ $selectedDestination->location }}</span>
                                <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">Dipilih Otomatis</span>
                            </div>
                        </div>
                        <!-- Hidden input untuk mengirim destination_id -->
                        <input type="hidden" name="destination_id" value="{{ $selectedDestinationId }}">
                        <p class="text-xs text-green-600 mt-1">
                            Destinasi telah dipilih otomatis. Tiket akan dibuat untuk destinasi ini.
                        </p>
                    @else
                        <!-- Jika destinasi tidak valid, tampilkan select biasa -->
                        <select name="destination_id" id="destination_id" required
                                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition bg-white">
                            <option value="">Pilih Destinasi</option>
                            @forelse($destinations as $destination)
                                <option value="{{ $destination->id }}">
                                    {{ $destination->name }} - {{ $destination->location }}
                                </option>
                            @empty
                                <option value="" disabled>Tidak ada destinasi yang tersedia untuk tiket baru</option>
                            @endforelse
                        </select>
                        <p class="text-xs text-red-500 mt-1">
                            Destinasi yang dipilih tidak valid. Silakan pilih destinasi lain.
                        </p>
                    @endif
                @else
                    <!-- Select biasa jika tidak ada selectedDestinationId -->
                    <select name="destination_id" id="destination_id" required
                            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition bg-white">
                        <option value="">Pilih Destinasi</option>
                        @forelse($destinations as $destination)
                            <option value="{{ $destination->id }}" 
                                    {{ (old('destination_id') == $destination->id) ? 'selected' : '' }}>
                                {{ $destination->name }} - {{ $destination->location }}
                            </option>
                        @empty
                            <option value="" disabled>Tidak ada destinasi yang tersedia untuk tiket baru</option>
                        @endforelse
                    </select>
                    @if($destinations->isEmpty())
                        <p class="text-sm text-gray-500 mt-1">
                            Semua destinasi yang memerlukan tiket sudah memiliki tiket, atau tidak ada destinasi yang memerlukan tiket.
                        </p>
                    @else
                        <p class="text-sm text-gray-500 mt-1">
                            Hanya menampilkan destinasi yang memerlukan tiket dan belum memiliki tiket.
                        </p>
                    @endif
                @endif
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga (IDR)</label>
                <input type="number" name="price" id="price" value="{{ old('price', 0) }}" required min="0"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
            </div>

            <div>
                <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', 0) }}" required min="0"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                <p class="text-xs text-gray-500 mt-1">Jumlah tiket yang tersedia untuk dijual</p>
            </div>

            <div class="pt-4 flex space-x-4">
                <button type="submit" class="flex-1 py-3 bg-green-500 text-white font-semibold rounded-lg transition hover:bg-green-600 focus:ring-2 focus:ring-green-300">
                    Simpan Tiket
                </button>
                @if(isset($selectedDestinationId) && $selectedDestinationId)
                    <a href="{{ route('dashboard.destination.show', $selectedDestinationId) }}" 
                       class="flex-1 py-3 bg-gray-500 text-white font-semibold rounded-lg transition hover:bg-gray-600 focus:ring-2 focus:ring-gray-300 text-center">
                        Lihat Destinasi
                    </a>
                @else
                    <a href="{{ route('dashboard.tickets.index') }}" 
                       class="flex-1 py-3 bg-gray-500 text-white font-semibold rounded-lg transition hover:bg-gray-600 focus:ring-2 focus:ring-gray-300 text-center">
                        Batal
                    </a>
                @endif
            </div>
        </form>
    </div>
</x-layout-admin>