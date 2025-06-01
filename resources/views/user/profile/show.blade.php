<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile | Dolan</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-tr from-gray-100 via-white to-gray-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
  <div class="px-6 sm:px-8 lg:px-12 py-10 min-h-screen">
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-3xl shadow-xl overflow-hidden animate-fade-in-up">

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Sidebar -->
        <div class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 text-white p-8 flex flex-col items-center justify-center">
          <div class="w-28 h-28 bg-white rounded-full overflow-hidden mb-4 shadow-lg">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}" alt="avatar" class="w-full h-full object-cover">
          </div>
          <h2 class="text-2xl font-bold text-gray-900 drop-shadow-md">{{ $user->name }}</h2>
          <p class="text-sm text-gray-900 opacity-90 drop-shadow-md">{{ $user->email }}</p>
        </div>

        <!-- Content -->
        <div class="md:col-span-2 p-8 sm:p-10 lg:p-12 space-y-10">
          <!-- Header -->
          <div>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white">Profil Saya</h3>
            <p class="text-gray-500 text-sm mt-2">Informasi akun yang terdaftar</p>
          </div>

          <!-- Info -->
          <div class="space-y-6">
            <div class="flex flex-col">
              <span class="text-gray-500 text-sm">Nama</span>
              <span class="font-medium text-gray-800 dark:text-white mt-1">{{ $user->name }}</span>
            </div>
            <div class="flex flex-col">
              <span class="text-gray-500 text-sm">Email</span>
              <span class="font-medium text-gray-800 dark:text-white mt-1">{{ $user->email }}</span>
            </div>
            <div class="flex flex-col">
              <span class="text-gray-500 text-sm">Password</span>
              <span class="font-medium text-gray-800 dark:text-white mt-1">********</span>
            </div>
            <div class="flex flex-col">
              <span class="text-gray-500 text-sm">Telepon</span>
              <span class="font-medium text-gray-800 dark:text-white mt-1">{{ $user->phone ?? '-' }}</span>
            </div>
          </div>

          <!-- Poin -->
          <div class="pt-6">
            <h4 class="text-xl font-bold text-gray-800 dark:text-white">🪙 Poin Saya</h4>
            <p class="text-3xl text-blue-600 font-semibold mt-2">{{ $user->points }} poin</p>
          </div>

          <!-- Badge -->
          <div class="pt-6">
            <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-2">🎖️ Badge yang Dimiliki</h4>

            @if($user->badges->isEmpty())
              <p class="text-gray-500 italic">Belum memiliki badge</p>
            @else
              <p class="text-gray-500 text-sm mb-4">Total badge: {{ $user->badges->count() }}</p>

              <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($user->badges as $badge)
                  <div class="bg-gray-100 dark:bg-gray-700 rounded-xl p-4 shadow flex items-center space-x-4">
                    @if ($badge->icon)
                      <img src="{{ asset($badge->icon) }}" alt="{{ $badge->name }}" class="w-10 h-10 object-contain">
                    @else
                      <div class="w-10 h-10 bg-indigo-500 text-white flex items-center justify-center rounded-full font-bold">
                        {{ strtoupper(substr($badge->name, 0, 1)) }}
                      </div>
                    @endif
                    <div>
                      <p class="text-gray-800 dark:text-white font-semibold">{{ $badge->name }}</p>
                      <p class="text-gray-500 text-sm">{{ $badge->description }}</p>
                    </div>
                  </div>
                @endforeach
              </div>
            @endif
          </div>

          <!-- Aksi -->
          <div class="pt-6 space-x-4">
            <a href="{{ route('user.profile.edit') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm md:text-base px-5 py-2 rounded-xl shadow-md transition transform hover:scale-105">
              Edit Profil
            </a>
            <a href="{{ route('logout') }}" class="inline-block bg-red-600 hover:bg-red-700 text-white font-semibold text-sm md:text-base px-5 py-2 rounded-xl shadow-md transition transform hover:scale-105">
              Logout
            </a>
          </div>

          <!-- Back to home -->
          <div class="mt-8 text-sm">
            <a href="/" class="text-indigo-600 hover:underline hover:translate-x-1 transition-all">&larr; Kembali ke Home</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</body>

</html>
