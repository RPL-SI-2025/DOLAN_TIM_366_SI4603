<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $destinations->name }} | UAT</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }
    .modal {
      display: none;
    }
    .modal.show {
      display: flex !important;
    }
  </style>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-b from-[#F0ECEC] to-white">

  <x-navbar />

  <main>
    <div>
      <section>
        <div class="px-4 mx-auto max-w-screen-xl py-24 lg:py-56 grid grid-cols-1 lg:grid-cols-2 gap-8">
          <div class="flex justify-between items-center mb-1 lg:col-span-2">
            <a href="{{ url('destinations') }}" class="underline text-gray-700 hover:text-gray-900">< Explore Another Tours</a>
          </div>

          <h1 class="text-5xl font-extrabold text-purple-800 lg:col-span-2">{{ $destinations->name }}</h1>

          <div class="flex justify-start order-1 lg:order-1">
            <img src="{{ asset('storage/' . $destinations->image) }}" alt="{{ $destinations->name }}" class="w-full h-auto max-w-md rounded-lg shadow-md">
          </div>

          <div class="text-black order-2 lg:order-2">
            <div class="flex justify-between items-center mt-4">
              <div class="flex flex-col">
                <h2 class="text-3xl font-bold mt-4">Tour Description</h2>
                <p class="mt-4 text-lg font-light">{{ $destinations->description }}</p>
              </div>

              @php
              $inWishlist = \App\Models\Wishlist::where('user_id', Auth::id())
                              ->where('destination_id', $destinations->id)
                              ->exists();

              $activeColor = '#6B21A8';
              $inactiveColor = '#D1D5DB';
              @endphp
      
              <form id="wishlistForm-{{ $destinations->id }}">
              @csrf
              <input type="hidden" name="destination_id" value="{{ $destinations->id }}">

              <button type="button"
              onclick="toggleWishlist({{ $destinations->id }})"
              id="wishlistBtn-{{ $destinations->id }}"
              class="p-4 rounded-lg transition ml-auto bg-purple-700 hover:bg-purple-800 border-2 border-navy-900 inline-flex items-center justify-center"
              style="border-color: {{ $inWishlist ? $activeColor : $inactiveColor }};">
            <svg xmlns="http://www.w3.org/2000/svg"
                width="24" height="24"
                fill="{{ $inWishlist ? $activeColor : $inactiveColor }}"
                id="bookmarkIcon-{{ $destinations->id }}"
                class="bi {{ $inWishlist ? 'bi-bookmark-fill' : 'bi-bookmark' }}"
                viewBox="0 0 16 16">
              <path d="M3 0a1 1 0 0 0-1 1v14l5-3 5 3V1a1 1 0 0 0-1-1H3z"/>
            </svg>
          </button>
            </form>
            </div>

            <div class="flex flex-col lg:flex-row lg:items-center lg:space-x-4 mt-4">
              @if($destinations->has_ticket && $destinations->ticket)
                <div class="flex flex-col">
                  <p class="text-4xl font-bold leading-tight mr-10">
                    <span class="font-bold text-black">IDR {{ number_format($destinations->ticket->price, 0, ',', '.') }}</span>
                  </p>
                  @if($destinations->ticket->stock <= 0)
                    <span class="text-red-500 font-semibold text-lg mt-2">Out of Stock</span>
                  @elseif($destinations->ticket->stock <= 10)
                    <span class="text-yellow-600 font-medium text-sm mt-2">Only {{ $destinations->ticket->stock }} tickets left!</span>
                  @else
                    <span class="text-green-600 font-medium text-sm mt-2">{{ $destinations->ticket->stock }} tickets available</span>
                  @endif
                </div>
              @else
                <p class="text-2xl font-medium leading-tight mr-10">
                  <span class="text-gray-600">{{ $destinations->has_ticket ? 'Contact for pricing' : '.' }}</span>
                </p>
              @endif
            </div>

            <div class="mt-8 flex space-x-4">
              <div class="flex space-x-4">
                <a href="#" class="px-6 py-3 bg-white text-black border border-black rounded-lg hover:bg-gray-100 transition font-bold outline outline-2 outline-black flex items-center">
                  DOWNLOAD DESTINATION
                  <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 ml-2">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                      <path d="M12.5535 16.5061C12.4114 16.6615 12.2106 16.75 12 16.75C11.7894 16.75 11.5886 16.6615 11.4465 16.5061L7.44648 12.1311C7.16698 11.8254 7.18822 11.351 7.49392 11.0715C7.79963 10.792 8.27402 10.8132 8.55352 11.1189L11.25 14.0682V3C11.25 2.58579 11.5858 2.25 12 2.25C12.4142 2.25 12.75 2.58579 12.75 3V14.0682L15.4465 11.1189C15.726 10.8132 16.2004 10.792 16.5061 11.0715C16.8118 11.351 16.833 11.8254 16.5535 12.1311L12.5535 16.5061Z" fill="#1C274C"></path>
                      <path d="M3.75 15C3.75 14.5858 3.41422 14.25 3 14.25C2.58579 14.25 2.25 14.5858 2.25 15V15.0549C2.24998 16.4225 2.24996 17.5248 2.36652 18.3918C2.48754 19.2919 2.74643 20.0497 3.34835 20.6516C3.95027 21.2536 4.70814 21.5125 5.60825 21.6335C6.47522 21.75 7.57754 21.75 8.94513 21.75H15.0549C16.4225 21.75 17.5248 21.75 18.3918 21.6335C19.2919 21.5125 20.0497 21.2536 20.6517 20.6516C21.2536 20.0497 21.5125 19.2919 21.6335 18.3918C21.75 17.5248 21.75 16.4225 21.75 15.0549V15C21.75 14.5858 21.4142 14.25 21 14.25C20.5858 14.25 20.25 14.5858 20.25 15C20.25 16.4354 20.2484 17.4365 20.1469 18.1919C20.0482 18.9257 19.8678 19.3142 19.591 19.591C19.3142 19.8678 18.9257 20.0482 18.1919 20.1469C17.4365 20.2484 16.4354 20.25 15 20.25H9C7.56459 20.25 6.56347 20.2484 5.80812 20.1469C5.07435 20.0482 4.68577 19.8678 4.40901 19.591C4.13225 19.3142 3.9518 18.9257 3.85315 18.1919C3.75159 17.4365 3.75 16.4354 3.75 15Z" fill="#1C274C"></path>
                    </g>
                  </svg>
                </a>

                <a href="{{ $destinations->contact_link }}" class="px-8 py-4 bg-gradient-to-r from-purple-500 to-black text-white font-bold rounded-lg hover:bg-gradient-to-r hover:from-purple-600 hover:to-black transition flex items-center">
                  Contact Us
                  <svg fill="#ffffff" height="24px" width="24px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/1999/xhtml" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve" stroke="#ffffff" transform="rotate(0)matrix(-1, 0, 0, 1, 0, 0)" class="ml-2">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                      <path d="M426.7,453.8l-38.1-79.1c-8.2-16.9-18.8-29.2-37.1-21.7l-36.1,13.4c-28.9,13.4-43.3,0-57.8-20.2l-65-147.9 c-8.2-16.9-3.9-32.8,14.4-40.3l50.5-20.2c18.3-7.6,15.4-23.4,7.2-40.3l-43.3-80.6c-8.2-16.9-25-21-43.3-13.5 c-36.6,15.1-66.9,38.8-86.6,73.9c-24,42.9-12,102.6-7.2,127.7c4.8,25.1,21.6,69.1,43.3,114.2c21.7,45.2,40.7,80.7,57.8,100.8 c17,20.1,57.8,75.1,108.3,87.4c41.4,10,86.1,1.6,122.7-13.5C434.8,486.7,434.8,470.8,426.7,453.8z"></path>
                    </g>
                  </svg>
                </a>
                
                @if($destinations->has_ticket)
                  @if($destinations->ticket && $destinations->ticket->stock > 0)
                    <a href="{{ route('tickets.show_ticket_form', ['destination' => $destinations->id]) }}" class="px-8 py-4 bg-gradient-to-r from-purple-500 to-black text-white font-bold rounded-lg hover:bg-gradient-to-r hover:from-purple-600 hover:to-black transition flex items-center">
                      Book Now
                    </a>
                  @else
                    <button onclick="showOutOfStockAlert()" class="px-8 py-4 bg-gray-400 text-white font-bold rounded-lg cursor-not-allowed flex items-center">
                      <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L18.364 5.636M5.636 18.364l12.728-12.728"></path>
                      </svg>
                      Sold Out
                    </button>
                  @endif
                @endif
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <section class="py-16">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8">{{ $destinations->name }} Highlights</h2>
        <div class="flex flex-wrap justify-center gap-4">
          @if (!empty($destinations->additional_images))
            @foreach (array_slice($destinations->additional_images, 0, 3) as $index => $image)
              <div class="bg-white rounded-lg shadow-md p-4 max-w-xs">
                <a href="{{ asset('storage/' . $image) }}" data-fancybox="gallery" data-caption="Tour Highlight {{ $index + 1 }}">
                  <img src="{{ asset('storage/' . $image) }}" alt="Additional Image" class="w-full h-auto rounded-lg mb-2">
                </a>
                <h3 class="text-xl font-bold mb-2 text-center">Tour Highlight</h3>
              </div>
            @endforeach
          @else
            <p class="text-gray-700 text-center">No additional images available.</p>
          @endif
        </div>
      </div>
    </section>

    <section class="py-16">
      <div class="container mx-auto px-4 grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-64">
        <div class="space-y-8">
          <div class="rounded-lg">
            <div class="bg-gradient-to-r from-purple-800 to-purple-500 text-white text-center p-3 rounded-t-lg shadow-lg">
              <h3 class="text-2xl font-bold">Tour Includes</h3>
            </div>
            <div class="bg-white p-6 rounded-b-lg shadow-lg">
              <ul class="list-disc list-inside space-y-2">
                @foreach (explode("\n", $destinations->tour_includes) as $include)
                  <li class="text-lg font-light">{{ $include }}</li>
                @endforeach
              </ul>
            </div>
            <div class="bg-gradient-to-r from-purple-800 to-purple-500 text-white text-center p-3 rounded-t-lg shadow-lg mt-8">
              <h3 class="text-2xl font-bold">Tour Payments</h3>
            </div>
            <div class="bg-white p-6 rounded-b-lg shadow-lg">
              <p>{{ $destinations->tour_payments }}</p>
            </div>
          </div>
        </div>
        <div class="flex flex-col lg:items-start lg:ml-32">
          <h2 class="text-3xl font-bold mb-8 underline text ml-7">Explore Other Tours</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-8">
            @foreach ($other_destinations->take(2) as $other_destination)
            <div class="max-w-sm drop-shadow-lg bg-white border border-gray-200 rounded-lg shadow-sm">
              <a href="{{ route('destinations.show', $other_destination->id) }}">
              <img class="rounded-t-lg w-full" src="{{ asset('storage/' . $other_destination->image) }}" alt="{{ $other_destination->name }}" />
              </a>
              <div class="p-5">
                <a href="{{ route('destinations.show', $other_destination->id) }}">
                  <h4 class="text-2xl font-bold tracking-tight text-gray-900">{{ $other_destination->name }}</h4>
                  <h5 class="mb-2 text-xl font-bold tracking-tight text-purple-900">{{ $other_destination->location }}</h5>
                </a>
                
                @if($other_destination->has_ticket && $other_destination->ticket)
                  @if($other_destination->ticket->stock > 0)
                    <p class="text-lg font-semibold text-gray-800 mb-3">
                      IDR {{ number_format($other_destination->ticket->price, 0, ',', '.') }}
                    </p>
                  @else
                    <div class="mb-3">
                      <p class="text-lg font-semibold text-red-600">
                        IDR {{ number_format($other_destination->ticket->price, 0, ',', '.') }}
                      </p>
                      <span class="text-sm text-red-500 font-medium">Out of Stock</span>
                    </div>
                  @endif
                @elseif($other_destination->has_ticket)
                  <p class="text-lg font-medium text-gray-600 mb-3">Contact for pricing</p>
                @else
                  <p class="text-lg font-medium text-green-600 mb-3"></p>
                @endif
                
                @if($other_destination->has_ticket && $other_destination->ticket && $other_destination->ticket->stock > 0)
                  <a href="{{ route('destinations.show', $other_destination->id) }}" class="inline-block text-white bg-gradient-to-br from-purple-400 to-black hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    Book Now
                  </a>
                @elseif($other_destination->has_ticket && $other_destination->ticket)
                  <button disabled class="inline-block text-gray-500 bg-gray-300 cursor-not-allowed font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    Sold Out
                  </button>
                @else
                  <a href="{{ route('destinations.show', $other_destination->id) }}" class="inline-block text-white bg-gradient-to-br from-purple-400 to-black hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    Learn More
                  </a>
                @endif
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>

    <section class="py-16">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8">Ratings & Reviews</h2>
        <div class="bg-white rounded-lg shadow-lg p-6">
          <div class="flex justify-between items-center mb-6">
            <div>
              <h3 class="text-2xl font-bold">Average Rating</h3>
              <div class="flex items-center mt-2">
                <span class="text-4xl font-bold text-purple-800">{{ number_format($destinations->averageRating(), 1) }}</span>
                <span class="text-gray-500 ml-2">/ 5</span>
              </div>
            </div>
            @auth
              @if(auth()->user()->isUser())
                <button onclick="openRatingModal()" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                  Write a Review
                </button>
              @endif
            @endauth
          </div>
          <div class="space-y-6" id="ratings-container">
            @php $ratingsToShow = $destinations->ratings()->with('user')->latest()->take(3)->get(); @endphp
            @forelse($ratingsToShow as $rating)
              <div class="border-b pb-6" data-rating-id="{{ $rating->id }}">
                <div class="flex justify-between items-start">
                  <div class="flex-1">
                    <h4 class="font-bold">{{ $rating->user->name }}</h4>
                    <div class="flex items-center mt-1">
                      <div class="flex text-yellow-400">
                        @for($i = 1; $i <= 5; $i++)
                          <svg class="w-4 h-4 {{ $i <= $rating->rating ? 'text-yellow-400 fill-current' : 'text-gray-300' }}" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.95-.69l1.07-3.292z"/>
                          </svg>
                        @endfor
                      </div>
                      <span class="text-gray-500 ml-2">{{ $rating->created_at->format('M d, Y') }}</span>
                    </div>
                    <!-- Tambahkan feedback di sini -->
                    @if($rating->feedback)
                      <p class="mt-3 text-gray-700 leading-relaxed">{{ $rating->feedback }}</p>
                    @endif
                  </div>
                  @if(auth()->check() && auth()->id() === $rating->user_id)
                    <button onclick="editRating({{ $rating->id }})" class="text-purple-600 hover:text-purple-800 ml-4">Edit</button>
                  @endif
                </div>
              </div>
            @empty
              <div class="text-center py-8">
                <p class="text-gray-500">Belum ada review untuk destinasi ini.</p>
              </div>
            @endforelse
          </div>
          
          <!-- Always show button regardless of rating count -->
          <div class="mt-6 text-center">
            <button onclick="showAllRatings()" class="text-purple-600 hover:text-purple-800 font-medium">
              Show All Reviews ({{ $destinations->ratings()->count() }})
            </button>
          </div>
        </div>
      </div>
    </section>

 <script>
  function showOutOfStockAlert() {
    Swal.fire({
      icon: 'warning',
      title: 'Tiket Sudah Habis!',
      text: 'Maaf, tiket untuk destinasi ini sudah habis. Silakan hubungi kami untuk informasi lebih lanjut atau coba destinasi lainnya.',
      confirmButtonText: 'Mengerti',
      confirmButtonColor: '#6B21A8'
    });
  }

  function toggleWishlist(destinationId) {
    const form = document.getElementById('wishlistForm-' + destinationId);
    const data = new FormData(form);
    const icon = document.getElementById('bookmarkIcon-' + destinationId);
    const button = document.getElementById('wishlistBtn-' + destinationId);

    fetch('{{ route("wishlist.toggle") }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
      },
      body: data
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        Swal.fire('Berhasil!', data.message, 'success');

        if (data.in_wishlist) {
          icon.classList.remove('bi-bookmark');
          icon.classList.add('bi-bookmark-fill');
          icon.setAttribute('fill', '#6B21A8');       // warna aktif
          button.style.borderColor = '#6B21A8';       // border warna aktif
        } else {
          icon.classList.remove('bi-bookmark-fill');
          icon.classList.add('bi-bookmark');
          icon.setAttribute('fill', '#D1D5DB');       // warna nonaktif
          button.style.borderColor = '#D1D5DB';       // border warna nonaktif
        }
      } else {
        Swal.fire('Oops!', data.message, 'error');
      }
    })
    .catch(() => {
      Swal.fire('Error!', 'Terjadi kesalahan. Coba lagi nanti.', 'error');
    });
  }
</script>

  </main>

  <!-- Include Modal Views -->
  @include('user.ratings.modal')
  @include('user.ratings.show-all-modal')

  <!-- Scripts should be at the bottom -->
  <script>
    // Set global variables for JavaScript
    window.destinationId = {{ $destinations->id }};
    window.currentUserId = {{ auth()->check() ? auth()->id() : 'null' }};
  </script>
  
  <!-- Include Rating JavaScript as separate script tag -->
  <script src="{{ Vite::asset('resources/js/rating-modal.js') }}"></script>

  <!-- Footer Section -->
  <footer class="bg-purple-100 text-center py-6 text-sm text-purple-600 mt-12">
    <p>&copy; {{ date('Y') }} Dolan. Website ini dikelola oleh tim Dolan Wisata.</p>
  </footer>
</body>

</html>
