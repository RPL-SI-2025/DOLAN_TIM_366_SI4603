<x-layout-admin>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Daftar Admin</h1>
            <a href="{{ route('dashboard.admin.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                + Tambah Admin
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Telepon</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($admins as $admin)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $admin->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $admin->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $admin->phone ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="flex space-x-2">
                                    <a href="{{ route('dashboard.admin.edit', $admin->id) }}"
                                       class="inline-flex items-center px-3 py-1 bg-yellow-400 text-white text-xs font-medium rounded hover:bg-yellow-500 transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('dashboard.admin.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus admin ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700 transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada admin.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout-admin>
