<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile | Dolan </title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<div class="px-6 sm:px-8 lg:px-12">
    <div class="min-h-screen bg-gradient-to-tr from-gray-100 via-white to-gray-100 py-10">
        <div class="max-w-4xl mx-auto px-6 sm:px-8 lg:px-12 bg-white rounded-3xl shadow-xl overflow-hidden animate-fade-in-up">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Sidebar Info -->
                <div class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 text-white p-8 flex flex-col items-center justify-center">
                    <div class="w-28 h-28 bg-white rounded-full overflow-hidden mb-4 shadow-lg">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}" alt="avatar" class="w-full h-full object-cover">
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 drop-shadow-md">{{ $user->name }}</h2>
                    <p class="text-sm text-gray-900 opacity-90 drop-shadow-md">{{ $user->email }}</p>
                </div>


                <!-- Main Content -->
                <div class="md:col-span-2 p-8 sm:p-10 lg:p-12 space-y-10"> <!-- Padding lebih besar di sini -->
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">Profil Saya</h3>
                        <p class="text-gray-500 text-sm mt-2">Informasi akun yang terdaftar</p>
                    </div>

                    <div class="space-y-6">
                        <div class="flex flex-col">
                            <span class="text-gray-500 text-sm">Nama</span>
                            <span class="font-medium text-gray-800 mt-1">{{ $user->name }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-gray-500 text-sm">Email</span>
                            <span class="font-medium text-gray-800 mt-1">{{ $user->email }}</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-gray-500 text-sm">Password</span>
                            <span class="font-medium text-gray-800 mt-1">********</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-gray-500 text-sm">Telepon</span>
                            <span class="font-medium text-gray-800 mt-1">{{ $user->phone ?? '-' }}</span>
                        </div>
                    </div>

                    <div class="pt-6">
                    <a href="{{ route('user.profile.edit') }}" class="inline-block bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 dark:hover:bg-blue-600 text-white font-semibold text-sm md:text-base px-5 py-2 rounded-xl shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-1">
                        Edit Profil
                    </a>
                    <a href="{{ route('logout') }}" class="inline-block bg-red-600 dark:bg-red-500 hover:bg-red-700 dark:hover:bg-red-600 text-white font-semibold text-sm md:text-base px-5 py-2 rounded-xl shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-1">
                        Logout
                    </a>


                    </div>

                    <div class="mt-8 text-sm">
                        <a href="/" class="text-indigo-600 hover:underline hover:translate-x-1 transition-all">&larr; Kembali ke Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
