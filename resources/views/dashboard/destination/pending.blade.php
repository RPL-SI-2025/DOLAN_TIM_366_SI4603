<x-layout-admin>
    <x-slot name="title">Destinasi Pending</x-slot>
    
    <div class="mt-10">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Destinasi Pending dari User</h2>
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
                                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition">
                                                Approve
                                            </button>
                                        </form>
                                        <form action="{{ route('dashboard.destination.updateStatus', $destination->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="denied">
                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition">
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