<x-layout-admin>
    <x-slot name="title">Destinasi Pending</x-slot>
    
    <div class="mt-10">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Permintaan Destinasi Wisata dari User</h2>
        <div class="overflow-hidden bg-white shadow-md rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Destinasi</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dibuat Oleh</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $pendingDestinations = \App\Models\Destination::where('status', 'pending')->get();
                        @endphp
                        @forelse ($pendingDestinations as $destination)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $destination->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ $destination->user->name ?? 'Unknown' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">{{ ucfirst($destination->status) }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">
                                    <div class="flex space-x-2">
                                        <form action="{{ route('dashboard.destination.updateStatus', $destination->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded-lg shadow-md transition focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-50">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('dashboard.destination.updateStatus', $destination->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="denied">
                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-lg shadow-md transition focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-50">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                                Deny
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-3 text-center text-gray-500 italic">
                                    Tidak ada destinasi pending.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout-admin>