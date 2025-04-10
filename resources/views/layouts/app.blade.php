<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dolan</title>
  
  <!-- Vite Tailwind CSS -->
  @vite('resources/css/app.css')

  <!-- Flowbite JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js" defer></script>
</head>
<body class="bg-white text-gray-900">

  <!-- NAVBAR SECTION -->
  <nav class="bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 shadow-md rounded-b-3xl">
    <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
      <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="/images/logo.png" class="h-8" alt="Dolan Logo" />
        <span class="self-center text-2xl font-semibold text-white whitespace-nowrap">Dolan</span>
      </a>

      <!-- Mobile menu button -->
      <button data-collapse-toggle="navbar-default" type="button" 
              class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden 
                     hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" 
              aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" 
             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" 
                stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
      </button>

      <!-- Navbar links -->
      <div class="hidden w-full md:block md:w-auto" id="navbar-default">
        <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg 
                   bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-transparent">
          <li><a href="/" class="block py-2 px-3 text-white hover:text-purple-200">Home</a></li>
          <li><a href="#" class="block py-2 px-3 text-white hover:text-purple-200">Tours</a></li>
          <li><a href="#" class="block py-2 px-3 text-white hover:text-purple-200">Gallery</a></li>
          <li><a href="#" class="block py-2 px-3 text-white hover:text-purple-200">Review</a></li>
          <li><a href="#" class="block py-2 px-3 text-white hover:text-purple-200">Contribute</a></li>
        </ul>
      </div>

      <!-- Sign In button -->
      <button class="text-white bg-purple-600 hover:bg-purple-700 rounded-full px-6 py-2 transition">
        Sign In
      </button>
    </div>
  </nav>

  <!-- MAIN CONTENT SECTION -->
  <main>
    @yield('content')
  </main>

</body>
</html>
