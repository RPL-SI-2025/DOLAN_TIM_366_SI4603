<x-layout-admin>
<div class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-3">
            <!-- Sidebar Info -->
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 text-white p-6 flex flex-col items-center justify-center">
                <div class="w-24 h-24 bg-white rounded-full overflow-hidden mb-4 shadow-md">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}" alt="avatar" class="w-full h-full object-cover">
                </div>
                <h2 class="text-xl font-semibold">{{ $user->name }}</h2>
                <p class="text-sm opacity-80">{{ $user->email }}</p>
            </div>

            <!-- Main Content -->
            <div class="md:col-span-2 p-6">
                <h3 class="text-2xl font-semibold text-gray-800 mb-4">Detail Profil</h3>

                <div class="space-y-4">
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-600">Nama</span>
                        <span class="text-gray-900">{{ $user->name }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-600">Email</span>
                        <span class="text-gray-900">{{ $user->email }}</span>
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-600">Password</span>
                        <span class="text-gray-900">********</span> <!-- Password disembunyikan -->
                    </div>
                    <div class="flex justify-between border-b pb-2">
                        <span class="text-gray-600">Telepon</span>
                        <span class="text-gray-900">{{ $user->phone ?? 'Tidak ada' }}</span>
                    </div>
                </div>

                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ route('dashboard.profile.edit') }}" class="bg-blue-600 text-white px-5 py-2 rounded-xl hover:bg-blue-700 transition shadow-sm">Edit Profil</a>
                    <form action="{{ route('dashboard.profile.destroy') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-5 py-2 rounded-xl hover:bg-red-700 transition shadow-sm">Hapus Akun</button>
                    </form>
                </div>

                <div class="mt-8 text-sm space-x-4">
                    <a href="{{ route('dashboard.index') }}" class="text-gray-600 hover:underline">← Kembali ke Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>

</x-layout-admin>
