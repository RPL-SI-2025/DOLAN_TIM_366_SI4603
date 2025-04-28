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

    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">

        <!-- Section with title, subtitle, and cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-5">
            @if($destinations->isEmpty())
            <p class="text-center text-gray-500 dark:text-gray-400">No destinations available at the moment.</p>
            @else
            @foreach($destinations as $destination)
            <div class="max-w-sm drop-shadow-lg bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                <img class="rounded-t-lg w-full" src="{{ asset($destination->image)}}" alt="{{ $destination->name }}" />
                </a>
                <div class="p-5">
                <a href="#">
                    <h4 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $destination->name }}</h4>
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-purple-900 dark:text-white">{{ $destination->location }}</h5>
                </a>
                <div class="flex items-center mb-2">
                    <p class="text-xs font-normal text-gray-700 dark:text-gray-400">Rp. {{ $destination->price }}</p>
                </div>

                <a href="{{ route('destinations.show', $destination->id) }}" class="inline-block text-white bg-gradient-to-br from-purple-400 to-black hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Book Now</a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
    </main>
</body>
</html>

