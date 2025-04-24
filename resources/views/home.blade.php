<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Dolan - Destinasi Wisata Nusantara</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet"/>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-image: url('https://placehold.co/1920x1080/EEE4F4/EEE4F4'); /* Background gambar */
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      position: relative;
    }

    /* Styling untuk promo */
    #promo {
      background-color:rgba(116, 110, 123, 0.39);
      color: black;
      font-weight: bold;
      padding: 15px 30px;
      border-radius: 30px;
      display: inline-block;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      font-size: 1.2rem;
      text-align: center;
      width: auto;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      margin-top: -30px;
      margin-bottom: 30px;
    }

    #promo i {
      margin-right: 10px;
    }

    /* Hover effect untuk promo */
    #promo:hover {
      transform: scale(1.05); /* Memberikan efek pembesaran saat hover */
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
    }

    .grid:hover .hover-trigger {
    filter: grayscale(100%) blur(3px) brightness(50%);
    transition: all 0.3s ease;
  }
  
  .grid:hover .hover-trigger:hover {
    filter: grayscale(0%) blur(0px);
    transform: scale(1.1);
    transition: all 0.3s ease;
  }
  </style>
</head>
<body class="text-gray-800">

<x-navbar>

</x-navbar>

  <!-- Main Content -->
  <main class="container mx-auto px-4 py-16 text-center">
    <!-- Promo Section -->
    <div id="promo">
      <i class="fas fa-tag"></i> <!-- Ikon promo untuk menunjukkan ini adalah promo -->
      Loading Promo...
    </div>

    <h1 class="text-4xl font-bold mb-4">Destinasi Wisata Nusantara</h1>
    <p class="text-gray-600 mb-8">Jelajahi keindahan Nusantara! Temukan destinasi wisata terbaik di Indonesia, dari pantai eksotis</br>
    hingga pegunungan menakjubkan. Rencanakan petualangan impianmu sekarang!</p>
    <button class="bg-purple-600 text-white px-6 py-3 rounded-full text-lg">Explore Indonesia Tours</button>

       <!-- New Interactive Cards Section -->
       <section class="py-12">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mt-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <a href="#" class="relative group hover-trigger shadow-lg">
        <img class="w-full h-96 object-cover rounded-lg" src="https://auto2000.co.id/berita-dan-tips/_next/image?url=https%3A%2F%2Fastradigitaldigiroomuat.blob.core.windows.net%2Fstorage-uat-001%2Ftempat-wisata-di-jawa-tengah.jpg&w=3840&q=75" alt="Explore Mountains">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          <h3 class="text-white text-xl font-semibold">Explore Jawa</h3>
        </div>
        <div class="absolute bottom-4 left-4 text-white">
          <p class="text-sm">Places</p>
          <h4 class="text-lg font-bold">Jawa</h4>
        </div>
        </a>
        <a href="#" class="relative group hover-trigger shadow-lg">
        <img class="w-full h-96 object-cover rounded-lg" src="https://asset.kompas.com/crops/hHV9rHYhH9wEUvLR4uf8fz2Ow_I=/47x0:980x622/1200x800/data/photo/2023/02/07/63e1e9484201d.jpg" alt="Explore Beaches">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          <h3 class="text-white text-xl font-semibold">Explore Sulawesi</h3>
        </div>
        <div class="absolute bottom-4 left-4 text-white">
          <p class="text-sm">Places</p>
          <h4 class="text-lg font-bold">Sulawesi</h4>
        </div>
        </a>
        <a href="#" class="relative group hover-trigger shadow-lg">
        <img class="w-full h-96 object-cover rounded-lg" src="https://asset.kompas.com/crops/BShYREKiSk5jDHVI6LxR5llMzKo=/0x0:729x486/1200x800/data/photo/2020/06/12/5ee30a5cac0fa.jpg" alt="Explore Cities">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          <h3 class="text-white text-xl font-semibold">Explore Sumatera</h3>
        </div>
        <div class="absolute bottom-4 left-4 text-white">
          <p class="text-sm">Places</p>
          <h4 class="text-lg font-bold">Sumatera</h4>
        </div>
        </a>
        <a href="#" class="relative group hover-trigger shadow-lg">
        <img class="w-full h-96 object-cover rounded-lg" src="https://awsimages.detik.net.id/community/media/visual/2019/02/28/e27d496c-d76b-4415-8cc3-d1131c07215f_169.jpeg?w=1200" alt="Explore Forests">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          <h3 class="text-white text-xl font-semibold">Explore Papua</h3>
        </div>
        <div class="absolute bottom-4 left-4 text-white">
          <p class="text-sm">Places</p>
          <h4 class="text-lg font-bold">Papua</h4>
        </div>
        </a>
      </div>
      </div>
    </section>
    <!-- End of Interactive Cards Section -->

    <div id="destinations" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mt-12">
      <!-- Destinasi akan dimuat di sini dengan AJAX -->
    </div>

    <!-- Supported By -->
    <div class="mt-16">
      <h2 class="text-xl font-semibold mb-4">Supported By:</h2>
      <div class="flex justify-center space-x-8">
        <img class="h-20" src="images/Kemenparekraf.webp" alt="Supporter 1"/>
        <img class="h-16" src="images/Pesona-Indonesia-Logo.png" alt="Pesona Indonesia"/>
      </div>
    </div>

    <!-- Rating Section -->
    <div class="mt-8 flex justify-center space-x-8">
      <div class="text-center">
        <i class="fas fa-star text-yellow-500 text-2xl"></i>
        <p class="text-gray-600">Rating 4.8/5</p>
        <p class="text-gray-400">62 users</p>
      </div>
      <div class="text-center">
        <i class="fab fa-google text-red-500 text-2xl"></i>
        <p class="text-gray-600">On Google Review</p>
        <p class="text-gray-400">82 users</p>
      </div>
    </div>
  </main>

  <!-- JavaScript -->
  <script>
  $(document).ready(function() {
  // Load Promo
  function loadPromo() {
    $.ajax({
      url: '{{ route('promo.get') }}', // Pastikan rutenya benar
      method: 'GET',
      success: function(data) {
        var promo = data; // Data promo yang diterima
        // Menampilkan promo
        $('#promo').html(`
          <i class="fas fa-tag"></i> <!-- Ikon promo -->
          <strong>${promo.title}</strong>
        `);
      }
    });
  }

  // Load Destinations
  function loadDestinations() {
    $.ajax({
      url: '{{ route('destinations.get') }}', // Pastikan rutenya benar
      method: 'GET',
      success: function(data) {
        var destinations = data; // Data destinasi yang diterima
        var displayedDestinations = []; // Menyimpan destinasi yang sudah ditampilkan
        var htmlContent = '';
        var count = 0; // Menyimpan jumlah destinasi yang ditampilkan

        // Membuat card untuk setiap destinasi
        destinations.forEach(function(destination) {
          // Mengecek apakah destinasi sudah ditampilkan
          if (!displayedDestinations.includes(destination.id)) {
            htmlContent += `
              <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img class="w-full h-48 object-cover" src="/storage/images/${destination.image}" alt="${destination.name}"/>
                <div class="p-4">
                  <h3 class="text-lg font-semibold">${destination.name}</h3>
                  <p>${destination.description}</p>
                </div>
              </div>
            `;

            // Menambahkan ID destinasi ke array displayedDestinations
            displayedDestinations.push(destination.id);

            count++;

            // Jika sudah menampilkan 4 destinasi, berhenti
            if (count >= 4) {
              return false;
            }
          }
        });

        // Menambahkan card ke dalam kontainer jika ada destinasi
        if (htmlContent) {
          $('#destinations').html(htmlContent);
        }
      }
    });
  }

  // Memanggil fungsi untuk memuat promo dan destinasi pertama kali saat halaman dimuat
  loadPromo();
  loadDestinations();

  // Atur interval untuk mengambil data baru setiap 5 detik
  setInterval(function() {
    loadPromo();
    loadDestinations();
  }, 5000); // 5 detik
});

  </script>
</body>
</html>
