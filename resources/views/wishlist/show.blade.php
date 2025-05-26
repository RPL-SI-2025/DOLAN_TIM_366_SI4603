<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
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
<body class="bg-purple-50 font-poppins">
<x-navbar></x-navbar>

<main class="pt-24 px-4 sm:px-8 lg:px-16 pb-20 bg-purple">
<div class="max-w-8xl mx-auto text-center mt-10 mb-12">
  <h1 class="text-5xl font-extrabold text-gray-900 mb-3">Wishlist</h1>
  <p class="text-gray-600 text-lg">Lihat destinasi yang sudah kamu simpan dan siap dijelajahi!</p>
</div>

  @if($wishlists->isEmpty())
    <p class="text-center text-gray-500 text-lg font-medium mt-20">
      Your wishlist is empty. Start adding your favorite destinations!
    </p>
  @else
    <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
      @foreach($wishlists as $wishlist)
        <div class="bg-white rounded-lg shadow-lg hover:shadow-xl transition relative group flex flex-col justify-between">
          <a href="{{ route('destinations.show', $wishlist->destination_id) }}" class="block">
            <img class="rounded-t-lg w-full h-48 object-cover" src="{{ asset($wishlist->destination->image) }}" alt="{{ $wishlist->destination_name }}">
          </a>
          <div class="p-5 text-center">
            <h3 class="text-xl font-semibold text-gray-800">{{ $wishlist->destination_name }}</h3>
            <p class="text-purple-700 font-medium mt-1 text-sm">{{ $wishlist->destination->location }}</p>

            <!-- Tombol Hapus -->
            <div class="mt-5">
              <button
                data-modal-target="removeModal"
                data-modal-toggle="removeModal"
                data-wishlist-id="{{ $wishlist->id }}"
                data-destination-name="{{ $wishlist->destination_name }}"
                type="button"
                class="text-sm text-red-600 border border-red-600 px-4 py-1.5 rounded-full hover:bg-red-50 transition"
                onclick="openRemoveModal(this)">
                Hapus dari wishlist
              </button>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</main>

<!-- Remove Confirmation Modal -->
<div id="removeModal" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 left-0 right-0 z-50 w-full h-full flex items-center justify-center bg-black bg-opacity-50">
  <div class="relative p-4 w-full max-w-md h-auto">
    <div class="bg-white rounded-lg shadow-lg relative">
      <!-- Close Button -->
      <button type="button" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600 bg-transparent rounded-lg text-sm p-1.5" data-modal-hide="removeModal" aria-label="Close modal">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
      </button>

      <!-- Modal Content -->
      <div class="p-6 text-center">
        <svg aria-hidden="true" class="mx-auto mb-4 text-red-600 w-14 h-14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M12 2a10 10 0 11-7.07 17.07 10 10 0 017.07-17.07z"/>
        </svg>
        <h3 id="modalTitle" class="mb-5 text-lg font-normal text-gray-500">
          Are you sure you want to remove this destination from your wishlist?
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

  // Tutup modal kalau klik tombol close atau cancel
  modal.querySelector('button[data-modal-hide="removeModal"]').addEventListener('click', () => {
    modal.classList.add('hidden');
  });

  // Tutup modal kalau klik di luar modal content
  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.classList.add('hidden');
    }
  });

  // Optional: tutup modal dengan tombol ESC
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
      modal.classList.add('hidden');
    }
  });
</script>

</body>
</html>
