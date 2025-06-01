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
            <h4 class="text-xl font-bold text-gray-800 dark:text-white mb-2 flex items-center gap-2">
              <span class="text-2xl">🎖️</span> Badge yang Dimiliki
            </h4>

            @if($user->badges->isEmpty())
              <div class="flex items-center gap-2 bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mt-2">
              <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-gray-500 italic">Belum memiliki badge</span>
                </div>
              @else
                <div class="flex items-center justify-between mb-4">
                <p class="text-gray-500 text-sm">Total badge: <span class="font-semibold text-blue-600">{{ $user->badges->count() }}</span></p>
                <div class="flex -space-x-2">
                  @foreach($user->badges->take(3) as $badge)
                  @if ($badge->icon)
                    <img src="{{ asset($badge->icon) }}" alt="{{ $badge->name }}" class="w-8 h-8 object-contain rounded-full border-2 border-white shadow">
                  @else
                    <div class="w-8 h-8 bg-indigo-500 text-white flex items-center justify-center rounded-full font-bold border-2 border-white shadow">
                    {{ strtoupper(substr($badge->name, 0, 1)) }}
                    </div>
                  @endif
                  @endforeach
                  @if($user->badges->count() > 3)
                  <span class="w-8 h-8 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 flex items-center justify-center rounded-full text-xs font-semibold border-2 border-white shadow">+{{ $user->badges->count() - 3 }}</span>
                  @endif
                </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($user->badges as $badge)
                  <div class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-gray-800 dark:via-gray-700 dark:to-gray-800 rounded-xl p-4 shadow hover:shadow-lg transition flex items-center gap-4">
                  @if ($badge->icon)
                    <img src="{{ asset($badge->icon) }}" alt="{{ $badge->name }}" class="w-12 h-12 object-contain rounded-full border-2 border-indigo-400 dark:border-indigo-600 shadow flex-shrink-0">
                  @else
                    <div class="w-12 h-12 bg-indigo-500 text-white flex items-center justify-center rounded-full font-bold text-lg border-2 border-indigo-400 dark:border-indigo-600 shadow flex-shrink-0">
                    {{ strtoupper(substr($badge->name, 0, 1)) }}
                    </div>
                  @endif
                  <div class="flex flex-col min-w-0">
                    <span class="font-semibold text-gray-800 dark:text-white break-words">{{ $badge->name }}</span>
                    <span class="text-gray-500 text-xs mt-1 break-words">{{ $badge->description }}</span>
                  </div>
                  </div>
                @endforeach
                </div>
              </div>
            @endif

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
