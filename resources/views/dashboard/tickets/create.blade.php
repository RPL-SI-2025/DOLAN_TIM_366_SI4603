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
                <select name="destination_id" id="destination_id" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition bg-white">
                    <option value="">Pilih Destinasi</option>
                    @foreach($destinations as $destination)
                        <option value="{{ $destination->id }}" 
                                {{ (old('destination_id') == $destination->id || (isset($selectedDestinationId) && $selectedDestinationId == $destination->id)) ? 'selected' : '' }}>
                            {{ $destination->name }}
                        </option>
                    @endforeach
                </select>
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

            <div>
                <label for="ticket_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Tiket (Opsional)</label>
                <input type="date" name="ticket_date" id="ticket_date" value="{{ old('ticket_date') }}"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
            </div>
            
            <div class="pt-4">
                <button type="submit" class="w-full py-3 bg-green-500 text-white font-semibold rounded-lg transition hover:bg-green-600 focus:ring-2 focus:ring-green-300">
                    Simpan Tiket
                </button>
            </div>
        </form>
    </div>
</x-layout-admin>