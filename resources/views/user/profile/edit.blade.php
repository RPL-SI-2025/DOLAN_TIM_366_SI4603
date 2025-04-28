<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<div class="w-full max-w-2xl mx-auto mt-16 px-4 sm:px-6">
        <div class="bg-white dark:bg-gray-900 shadow-md rounded-2xl overflow-hidden transition">
            <div class="flex flex-col items-center text-center p-6">
                {{-- Avatar --}}
                <div class="relative group mb-3">
                    <img id="avatar-img" 
                         src="{{ $user->profile_photo_url ?: 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&size=96' }}" 
                         alt="User Avatar"
                         class="w-24 h-24 rounded-full border-2 border-blue-400 shadow-md transform group-hover:scale-105 transition duration-300 ease-in-out">
                    <div class="absolute inset-0 bg-black bg-opacity-40 rounded-full opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                        <label for="avatar-upload" class="text-white text-xs cursor-pointer">Ubah</label>
                    </div>
                    {{-- Input file untuk upload avatar --}}
                    <input type="file" id="avatar-upload" name="avatar" class="hidden" onchange="previewAvatar(event)">
                </div>

                <h2 class="text-lg font-semibold text-gray-800 dark:text-white">{{ $user->name }}</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">{{ $user->email }}</p>
            </div>

            {{-- Form --}}
            <form action="{{ route('user.profile.update') }}" method="POST" class="px-6 pb-8 space-y-5" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div>
                    <label for="name" class="block text-xs text-gray-500 mb-1">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 text-sm">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-xs text-gray-500 mb-1">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                           class="w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 text-sm">
                </div>

                {{-- Telepon --}}
                <div>
                    <label for="phone" class="block text-xs text-gray-500 mb-1">No. Telepon</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                           class="w-full rounded-lg border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white px-3 py-2 focus:outline-none focus:ring-1 focus:ring-blue-500 text-sm">
                </div>

                {{-- Tombol Simpan --}}
                <div class="flex justify-end pt-4 px-1">
                    <button type="submit"
                        class="bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 dark:hover:bg-blue-600 text-white font-semibold text-sm md:text-base px-5 py-2 rounded-xl shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-1">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Fungsi untuk menampilkan preview gambar avatar yang diupload
        function previewAvatar(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const avatarImg = document.getElementById('avatar-img');
                avatarImg.src = reader.result; // Ganti src gambar dengan gambar yang diupload
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>