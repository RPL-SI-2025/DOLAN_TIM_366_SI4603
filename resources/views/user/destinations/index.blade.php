<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Destination | Dolan</title>
    <style>
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
  @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gradient-to-b from-[#F0ECEC] to-white">
    <main>
        <div>
            <section class=" bg-white dark:bg-gray-900 bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern.svg')] dark:bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern-dark.svg')]">
                <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 z-10 relative">
                <x-navbar />
                    <a href="#" class="mt-10 inline-flex justify-between items-center py-1 px-1 pe-4 mb-7 text-sm text-purple-700 bg-purple-100 rounded-full dark:bg-purple-900 dark:text-purple-300 hover:bg-purple-200 dark:hover:bg-purple-800">
                        <span class="text-xs bg-purple-600 rounded-full text-white px-4 py-1.5 me-3">Promo</span> <span class="text-sm font-medium">Kunjungi wisata terbaru Raja Ampat sedang diskon sampai pukul 14.00 WIB</span> 
                        <svg class="w-2.5 h-2.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                    </a>
                    
                    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Destination</h1>
                    <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-200">Temukan destinasi wisata terbaik yang menawarkan pengalaman tak terlupakan, keindahan alam, dan budaya yang memukau.</p>
        
                </div>
                <div class="bg-gradient-to-b from-purple-50 to-transparent dark:from-purple-900 w-full h-full absolute top-0 left-0 z-0"></div>
            </section>

            </div>

            <div class="mb-7 animate-on-scroll">
    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        <!-- Sort and Filter Section -->
        <section class="flex justify-between items-center py-4 bg-white shadow-md rounded-lg px-6 animate-on-scroll">
          <div class="flex items-center">
            <label for="sort" class="text-lg font-medium text-gray-700">Sort by:</label>
            <select id="sort" class="ml-2 p-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
              <option value="popularity">Popularity</option>
              <option value="price">Price</option>
              <option value="duration">Duration</option>
            </select>
          </div>
          <div class="flex items-center">
            <label for="filter" class="text-lg font-medium text-gray-700">Filter by:</label>
            <select id="filter" class="ml-2 p-2 border border-gray-300 rounded-md focus:ring-purple-500 focus:border-purple-500">
              <option value="all">All</option>
              <option value="mountains">Mountains</option>
              <option value="cities">Cities</option>
              <option value="historical">Historical</option>
            </select>
          </div>
        </section>

        <!-- Section with title, subtitle, and cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-5 animate-on-scroll">
            @foreach($destinations as $destination)
            <div class="max-w-sm drop-shadow-lg bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg w-full" src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->title }}" />
                </a>
                <div class="p-5">
                    <a href="#">
                        <h4 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $destination->name }}</h4>
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-purple-900 dark:text-white">{{ $destination->location }}</h5>
                    </a>
                    <div class="flex items-center mb-2">
                        <svg fill="#949494" width="16px" height="16px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12,6a1,1,0,0,0-1,1v5a1,1,0,0,0,.293.707l3,3a1,1,0,0,0,1.414-1.414L13,11.586V7A1,1,0,0,0,12,6Z M23.812,10.132A12,12,0,0,0,3.578,3.415V1a1,1,0,0,0-2,0V5a2,2,0,0,0,2,2h4a1,1,0,0,0,0-2H4.827a9.99,9.99,0,1,1-2.835,7.878A.982.982,0,0,0,1,12a1.007,1.007,0,0,0-1,1.1,12,12,0,1,0,23.808-2.969Z"></path>
                        </svg>
                        <p class="text-xs font-normal text-gray-700 dark:text-gray-400 ml-2">Rp. {{ $destination->price }}</p>
                    </div>
                    <div class="flex items-center mb-2">
                        <svg fill="#949494" width="16px" height="16px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12,6a1,1,0,0,0-1,1v5a1,1,0,0,0,.293.707l3,3a1,1,0,0,0,1.414-1.414L13,11.586V7A1,1,0,0,0,12,6Z M23.812,10.132A12,12,0,0,0,3.578,3.415V1a1,1,0,0,0-2,0V5a2,2,0,0,0,2,2h4a1,1,0,0,0,0-2H4.827a9.99,9.99,0,1,1-2.835,7.878A.982.982,0,0,0,1,12a1.007,1.007,0,0,0-1,1.1,12,12,0,1,0,23.808-2.969Z"></path>
                        </svg>
                    </div>
                    <a href="{{ route('destinations.show', $destination->id) }}" class="inline-block text-white bg-gradient-to-br from-purple-400 to-black hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Book Now</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
    </main>
</body>
</html>

