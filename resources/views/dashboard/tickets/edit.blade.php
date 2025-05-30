<x-layout-admin>
    <x-slot name="title">Edit Tiket</x-slot>

    <div class="container mx-auto p-6 bg-white shadow-lg rounded-xl max-w-2xl">
        <h2 class="text-2xl font-semibold text-indigo-600 mb-8 text-center">Edit Tiket</h2>

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

        <form action="{{ route('dashboard.tickets.update', $ticket->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="ticket_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Tiket</label>
                <input type="text" name="ticket_name" id="ticket_name" value="{{ old('ticket_name', $ticket->ticket_name) }}" required
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
            </div>

            <div>
                <label for="destination_id" class="block text-sm font-medium text-gray-700 mb-1">Destinasi</label>
                <select name="destination_id" id="destination_id" required
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition bg-white">
                    <option value="">Pilih Destinasi</option>
                    @foreach($destinations as $destination)
                        <option value="{{ $destination->id }}" 
                                {{ (old('destination_id', $ticket->destination_id) == $destination->id) ? 'selected' : '' }}>
                            {{ $destination->name }} - {{ $destination->location }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga (IDR)</label>
                <input type="number" name="price" id="price" value="{{ old('price', $ticket->price) }}" required min="0"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
            </div>

            <div>
                <label for="ticket_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Tiket (Opsional)</label>
                <input type="date" name="ticket_date" id="ticket_date" 
                       value="{{ old('ticket_date', $ticket->ticket_date ? $ticket->ticket_date->format('Y-m-d') : '') }}"
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
            </div>
            
            <div class="pt-4 flex space-x-4">
                <button type="submit" class="flex-1 py-3 bg-green-500 text-white font-semibold rounded-lg transition hover:bg-green-600 focus:ring-2 focus:ring-green-300">
                    Update Tiket
                </button>
                <a href="{{ route('dashboard.tickets.show', $ticket->id) }}" 
                   class="flex-1 py-3 bg-gray-500 text-white font-semibold rounded-lg transition hover:bg-gray-600 focus:ring-2 focus:ring-gray-300 text-center">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layout-admin>