<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wishlist | Dolan</title>
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
                    
                    <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Wishlist</h1>
                    <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-200">Lihat destinasi favoritmu yang siap dijelajahi bersama orang tersayang!</p>
        
                </div>
                <div class="bg-gradient-to-b from-purple-50 to-transparent dark:from-purple-900 w-full h-full absolute top-0 left-0 z-0"></div>
            </section>

            </div>

  <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
    @if($wishlists->isEmpty())
      <p class="text-center text-gray-500 dark:text-gray-400">Wishlist kamu masih kosong. Yuk mulai simpan destinasi favoritmu!</p>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-5">
      @foreach($wishlists as $wishlist)
      <div class="max-w-sm drop-shadow-lg bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ route('destinations.show', $wishlist->destination_id) }}">
          <img class="rounded-t-lg w-full h-48 object-cover" src="{{ asset($wishlist->destination->image)}}" alt="{{ $wishlist->destination_name }}" />
        </a>
        <div class="p-5">
          <h4 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $wishlist->destination_name }}</h4>
          <h5 class="mb-2 text-xl font-bold tracking-tight text-purple-900 dark:text-white">{{ $wishlist->destination->location }}</h5>
          
          <div class="mt-4 flex justify-between items-center">
          <button
            data-modal-target="removeModal"
            data-modal-toggle="removeModal"
            data-wishlist-id="{{ $wishlist->id }}"
            data-destination-name="{{ $wishlist->destination_name }}"
            onclick="openRemoveModal(this)"
            class="text-gray-700 border border-gray-500 px-4 py-1.5 rounded-full text-sm hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white dark:border-gray-400 transition">
            Hapus dari wishlist
          </button>

          <a href="{{ route('destinations.show', $wishlist->destination_id) }}"
            class="text-white bg-gradient-to-br from-purple-500 to-black hover:from-purple-600 hover:to-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2 text-center">
            Detail
          </a>
        </div>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</main>

<!-- Modal -->
<div id="removeModal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 left-0 right-0 z-50 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
  <div class="relative p-4 w-full max-w-md h-auto">
    <div class="bg-white rounded-lg shadow-lg relative">
      <button type="button" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 bg-transparent rounded-lg text-sm p-1.5" data-modal-hide="removeModal" aria-label="Close modal">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
      </button>
      <div class="p-6 text-center">
        <svg aria-hidden="true" class="mx-auto mb-4 text-red-600 w-14 h-14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M12 2a10 10 0 11-7.07 17.07 10 10 0 017.07-17.07z"/>
        </svg>
        <h3 id="modalTitle" class="mb-5 text-lg font-normal text-gray-500">
          Apakah kamu yakin ingin menghapus destinasi ini dari wishlist?
        </h3>

        <form id="removeForm" method="POST" action="">
          @csrf
          @method('DELETE')
          <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2">
            Iya, hapus
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Script -->
<script>
  const modal = document.getElementById('removeModal');
  const form = modal.querySelector('#removeForm');
  const modalTitle = modal.querySelector('#modalTitle');

  function openRemoveModal(button) {
    const wishlistId = button.getAttribute('data-wishlist-id');
    const destinationName = button.getAttribute('data-destination-name');

    form.action = `/wishlist/remove/${wishlistId}`;
    modalTitle.textContent = `Ingin menghapus "${destinationName}" dari wishlist mu?`;

    modal.classList.remove('hidden');
  }

  modal.querySelector('button[data-modal-hide="removeModal"]').addEventListener('click', () => {
    modal.classList.add('hidden');
  });

  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.classList.add('hidden');
    }
  });

  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
      modal.classList.add('hidden');
    }
  });
</script>

<!-- Footer -->
<footer class="bg-purple-100 text-center py-6 text-sm text-purple-600 mt-12">
  <p>&copy; {{ date('Y') }} Dolan. Website ini dikelola oleh tim Dolan Wisata.</p>
</footer>
</body>
</html>
